#include <iostream>
#include <fstream>
#include <cstring>
#include <vector>
#include <map>
#include <cstdio>
#include <cstdlib>
#include <cctype>
#include <algorithm>
#include <windows.h>
#define putchar_unlocked putchar

using namespace std;

class Detail{
public:
    string MS;          // Definition
    char MR[10];        // Revision Date
    char DX[10];        // Data Established
    char UI[10];        // Unique ID
};

HANDLE hOut = GetStdHandle(STD_OUTPUT_HANDLE);

map<string, Detail> Mesh;
map<string, Detail>::iterator result, iter;

int load2Mesh(char* filename){
    fstream fp(filename, ios::in);
    string line;
    Detail detail;
    int num_data = 0;
    string MH;

    while(getline(fp, line)){
        if( line.compare(0, 2, "MH") == 0 ){
            line.erase(0, 5);
            MH = line;
        }
        else if( line.compare(0, 2, "MS") == 0 ){
            line.erase(0, 5);
            detail.MS = line;
        }
        else if( line.compare(0, 2, "MR") == 0 ){
            line.erase(0, 5);
            strcpy(detail.MR, line.c_str());
        }
        else if( line.compare(0, 2, "DX") == 0 ){
            line.erase(0, 5);
            strcpy(detail.DX, line.c_str());
        }
        else if( line.compare(0, 2, "UI") == 0 ){
            line.erase(0, 5);
            strcpy(detail.UI, line.c_str());
        }
        else{
            Mesh[MH] = detail;
            strcpy(detail.MR, "None");
            detail.MS = "None";
            num_data += 1;
        }
    }
    Mesh[MH] = detail; // Add last record
    num_data += 1;

    return num_data;
}

int showMenu(){
    cout << "[MESH SEARCH]\n";
    cout << "1: Search Term\n";
    cout << "2: Term Mapping\n";
    cout << "3: Display All Data\n";
    cout << "4: Exit\n";
    cout << "\nInput a number ...> ";
    int option;
    cin >> option;

    return option;
}

bool compareInsensitive(const string& s1, const string s2){
    if (s1.length() != s2.length()) return false;
    for( int i = 0; i < s1.length(); ++i ){
        if( tolower(s1[i]) != tolower(s2[i]) )
            return false;
    }
    return true;
}
void colorWord(char c){
    SetConsoleTextAttribute(hOut,  FOREGROUND_RED | FOREGROUND_GREEN | FOREGROUND_INTENSITY | 0x8000);
    cout << c ;
    SetConsoleTextAttribute(hOut,  FOREGROUND_RED | FOREGROUND_GREEN | FOREGROUND_BLUE);
}

int searchTerm(){
    cout << "Input Term ...> ";
    string term, tempterm;
    char c;
    gets(&c);
    getline(cin, term);
    tempterm = term;
    int num_result = 0;
    bool flag = 0;

    for( int i = 0; i < term.length(); ++i ){       // Change term to lower case
        term[i] = tolower(term[i]);
    }

    for( iter = Mesh.begin(); iter != Mesh.end(); ++iter){
        if( compareInsensitive(term, iter->first) )
        {
            cout << "\n";
            for(auto& c : iter->first)colorWord(c);
            cout << "\n";
            cout << "Definition: " << iter->second.MS << endl;
            cout << "Revision DATE: " << iter->second.MR << endl;
            cout << "Established DATE: " << iter->second.DX << endl;
            cout << "Unique ID: " << iter->second.UI << endl;
            flag = 1;
        }
    }

    for( iter = Mesh.begin(); iter != Mesh.end(); ++iter){
        string lowerMH = iter->first;
        for( int i = 0; i < lowerMH.length(); ++i ){       // Change MH to lower case
            lowerMH[i] = tolower(lowerMH[i]);
        }

        size_t found = lowerMH.find(term);
        if( found != string::npos && !compareInsensitive(term, iter->first)){
            cout << "\n";
            for(auto& c : iter->first)colorWord(c);
            cout << "\n";
            cout << "Definition: " << iter->second.MS << endl;
            cout << "Revision DATE: " << iter->second.MR << endl;
            cout << "Established DATE: " << iter->second.DX << endl;
            cout << "Unique ID: " << iter->second.UI << endl;
            flag = 1;
        }
    }
    if( !flag ){
        cout << "[" << tempterm << "] 0 result" << endl << endl;
    }

    return num_result;
}

bool myfunc(const string& a, const string& b){
    return a.length() == b.length() ? ( a < b ) : ( a.length() > b.length() );
}

void searchMappingTerm(){
    string outline, tempoutline;
    cout << "Input Text ...>" << endl;
    char c;
    gets(&c);
    getline(cin, outline);
    outline = " " + outline;
    tempoutline = outline;

    for( int i = 0; i < outline.length(); ++i ){
        outline[i] = tolower(outline[i]);
    }


    vector<string> mh;
    for( iter = Mesh.begin(); iter != Mesh.end(); ++iter ){
        mh.push_back(iter->first);
    }
    sort(mh.begin(), mh.end(), myfunc);

    vector<string> termFound;
    for( auto& term : mh ){
        string interm = term;
        for( int i = 0; i < interm.length(); ++i ){
            interm[i] = tolower(interm[i]);
        }
        size_t found = outline.find(" "+interm);
        if( found != string::npos ){
            termFound.push_back(term);
        }

        while( found != string::npos ){
            for( int i = found+1; i<found+term.length()+1; ++i)
                outline[i] = '`';

            found = outline.find(" "+interm);
        }
    }
    cout << "\n[Result]" << endl;
    cout << "----------------------------------------------------" << endl;

    for( int i = 1; i < outline.length(); ++i ){
        if( outline[i] == '`')
            colorWord(tempoutline[i]);
        else
            cout << tempoutline[i];
    }

    cout << "\n----------------------------------------------------\n";
    sort(termFound.begin(), termFound.end());
    for( auto& s : termFound ){
        for( auto& c : s)
            colorWord(c);
        iter = Mesh.find(s);
        cout << endl << iter->second.MS << endl << endl;
    }


}


void showAllTerm(){

    int row_count = 0;
    ios_base::sync_with_stdio(false);
    for( iter = Mesh.begin(); iter != Mesh.end(); ++iter ){
        ++ row_count;
        cout << "[" << row_count << "] " << iter->first << '\n';
    }
    ios_base::sync_with_stdio(true);
    cout << row_count << " records in MESH DB" << endl << endl;
}

int main(){

    cout << "mesh.db loaded. (" << load2Mesh("mesh.db") << ")" << endl << endl;

    int option = 0;

    while( option != 4 ){
        option = showMenu();
        switch (option)
        {
        case 1:
            searchTerm();
            break;
        case 2:
            searchMappingTerm();
            break;
        case 3:
            showAllTerm();
            break;
        default:
            break;
        }

        system("pause");
        system("cls");
    }

    return 0;
}
