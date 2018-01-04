<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>MeSH on Demand</title>
        <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="dist/css/sticky-footer-navbar.css">
        <!-- Add jQuery library -->
        <script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
        <!-- Add Button helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <!-- Add Thumbnail helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <!-- Add Media helper (this is optional) -->
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <style>
            .named_entity{
                color: blue;
                background: yellow;
                text-decoration: none;
            }
        </style>
        <script>
            function findNamedTerms() {
                if( $('#contxt').text != '')    
                {
                    var querystr = $('#contxt').val();
                    console.log(querystr);
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                           document.getElementById("txtHint").innerHTML = this.responseText+"<br><br><br><br><br>";
                        }
                    }
                }
                xmlhttp.open("GET", "querymapping.php?s="+querystr);
                xmlhttp.send();
                    
            }
            $('.named_entity').fancybox({
                        type : 'iframe',
                        padding : 5
            });

            function FillTextContent(i)
            {
                var textcontent = [
                     "This paper provides the current state of nuclear cardiology in China and contrasts it with the state of nuclear cardiology in the United States (US). The West China Hospital and New York- Presbyterian Hospital (NYPH) were used as representative hospitals to contrast nuclear cardiology in China and the US, respectively. In 2015, there were 101 medical cyclotrons, 774 SPECT or SPECT/CT, 240 PET/CT, and 6 PET/MR cameras in China. Most (*90%) of the nuclear cardiology studies are gated SPECT myocardial perfusion imaging (MPI), and *10% are other types of studies including MUGA, PET/CT MPI, and viability studies. There are differences in nuclear cardiology between the West China Hospital and NYPH and these include those in cardiac stress tests, SPECT/CT acquisition protocols, PET/CT blood flow and viability studies, reimbursement, and fellowship training. In this paper, we aim to present status of nuclear cardiology in China and provide potential solutions.",
                    "Diatom biosilica may offer an interesting perspective in the search for sustainable solutions meeting the high demand for heterogeneous catalysts. Diatomaceous earth (diatomite), i.e., fossilized diatoms, is already used as adsorbent and carrier material. While diatomite is abundant and inexpensive, freshly harvested and cleaned diatom cell walls have other advantages, with respect to purity and uniformity. The present paper demonstrates an approach to modify diatoms both in vivo and in vitro to produce a porous aluminosilicate that is serving as a potential source for sustainable catalyst production. The obtained material was characterized at various processing stages with respect to morphology, elemental composition, surface area, and acidity. The cell walls appeared normal without morphological changes, while their aluminum content was raised from the molar ratio n(Al):n(Si) 1:600 up to 1:50. A specific surface area of 55 m2/g was measured. The acidity of the material increased from 149 to 320 μmol NH3/g by ion exchange, as determined by NH3 TPD. Finally, the biosilica was examined by an acid catalyzed test reaction, the alkylation of benzene. While the cleaned cell walls did not catalyze the reaction at all, and the ion exchanged material was catalytically active. This demonstrates that modified biosilica does indeed has potential as a basis for future catalytically active materials.",
                    "A coordinated and faithful DNA damage response is of central importance for maintaining genomic integrity and survival. Here, we show that exposure of human cells to benzo(a)pyrene 9,10-diol-7,8-epoxide (BPDE), the active metabolite of benzo(a)pyrene (B(a)P), which represents a most important carcinogen formed during food preparation at high temperature, smoking and by incomplete combustion processes, causes a prompt and sustained upregulation of the DNA repair genes DDB2, XPC, XPF, XPG and POLH. Induction of these repair factors on RNA and protein level enhanced the removal of BPDE adducts from DNA and protected cells against subsequent BPDE exposure. However, through the induction of POLH the mutation frequency in the surviving cells was enhanced. Activation of these adaptive DNA repair genes was also observed upon B(a)P treatment of MCF7 cells and in buccal cells of human volunteers after cigarette smoking. Our data provide a rational basis for an adaptive response to polycyclic aromatic hydrocarbons, which occurs however at the expense of mutations that may drive cancer formation.",
                    "The organophosphate temephos has been the main insecticide used against larvae of the dengue and yellow fever mosquito (Aedes aegypti) in Brazil since the mid-1980s. Reports of resistance date back to 1995; however, no systematic reports of widespread temephos resistance have occurred to date. As resistance investigation is paramount for strategic decision-making by health officials, our objective here was to investigate the spatial and temporal spread of temephos resistance in Ae. aegypti in Brazil for the last 12 years using discriminating temephos concentrations and the bioassay protocols of the World Health Organization. The mortality results obtained were subjected to spatial analysis for distance interpolation using semi-variance models to generate maps that depict the spread of temephos resistance in Brazil since 1999. The problem has been expanding. Since 2002-2003, approximately half the country has exhibited mosquito populations resistant to temephos. The frequency of temephos resistance and, likely, control failures, which start when the insecticide mortality level drops below 80%, has increased even further since 2004. Few parts of Brazil are able to achieve the target 80% efficacy threshold by 2010/2011, resulting in a significant risk of control failure by temephos in most of the country. The widespread resistance to temephos in Brazilian Ae. aegypti populations greatly compromise effective mosquito control efforts using this insecticide and indicates the urgent need to identify alternative insecticides aided by the preventive elimination of potential mosquito breeding sites.",
                    "Background: Starting dialysis at an advanced age is a clinical challenge and an ethical dilemma. The advantages of starting dialysis at “extreme” ages are questionable as high dialysis-related morbidity induces a reflection on the cost- benefit ratio of this demanding and expensive treatment in a person that has a short life expectancy. Where clinical advantages are doubtful, ethical analysis can help us reach decisions and find adapted solutions.Case presentation: Mr. H is a ninety-year-old patient with end-stage kidney disease that is no longer manageable with conservative care, in spite of optimal nutritional management, good blood pressure control and strict clinical and metabolic evaluations; dialysis is the next step, but its morbidity is challenging. The case is analysed according to principlism (beneficence, non-maleficence, justice and respect for autonomy).In the setting of care, dialysis is available without restriction; therefore the principle of justice only partially applied, in the absence of restraints on health-care expenditure. The final decision on whether or not to start dialysis rested with Mr. H (respect for autonomy). However, his choice depended on the balance between beneficence and non-maleficence. The advantages of dialysis in restoring metabolic equilibrium were clear, and the expected negative effects of dialysis were therefore decisive. Mr. H has a contraindication to peritoneal dialysis (severe arthritis impairing self-performance) and felt performing it with nursing help would be intrusive. Post dialysis fatigue, poor tolerance, hypotension and intrusiveness in daily life of haemodialysis patients are closely linked to the classic thrice-weekly, four-hour schedule. A personalized incremental dialysis approach, starting with one session per week, adapting the timing to the patient’s daily life, can limit side effects and “dialysis shock”.Conclusions: An individualized approach to complex decisions such as dialysis start can alter the delicate benefit/ side-effect balance, ultimately affecting the patient’s choice, and points to a narrative, tailor-made approach as an alternative to therapeutic nihilism, in very old and fragile patients."
                    ];
                    document.getElementById("contxt").innerHTML = textcontent[i];
            }
        </script>
    </head>
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="https://meshb.nlm.nih.gov/search">NTNU MeSH Browser</a>
                <span>&nbsp&nbsp&nbsp</span>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="hierarchy.php">MeSH Hierarchy</a></li>
                    <li><a href="searchterm.php">MeSH Term Query</a></li>
                    <li class="active"><a href="mapping.php">MeSH on Demand</a></li>
                </ul>
            </div>
            
        </div>
                
    </nav>
        <div class="container">
            <div class="jumbotron">
                <h1>MeSH on Demand</h1>
                <h2>Just Input It.</h2>
            </div>
            <div class="navbar-fixed-bottom" style="z-index: 100">
                <button class="btn btn-primary" id="Text1" onclick="FillTextContent(0);">Abstract #1</button>
                <button class="btn btn-primary" id="Text2" onclick="FillTextContent(1);">Abstract #2</button>
                <button class="btn btn-primary" id="Text3" onclick="FillTextContent(2)">Abstract #3</button>
                <button class="btn btn-primary" id="Text4" onclick="FillTextContent(3)">Abstract #4</button>
                <button class="btn btn-primary" id="Text5" onclick="FillTextContent(4)">Abstract #5</button><br>
                
            </div>
            <div class="jumbotron">
                <textarea class="form-control" id="contxt" rows="5" style="margin-top: 10px"></textarea><br />
                <div style="text-align: center;"><button class="btn btn-lg btn-primary" onclick="findNamedTerms();">Find it!</button></div>
            </div>
            <div class="jumbotron">
                <h2><span class="label label-primary">Result</span></h2>
                <div id="txtHint" style="z-index: 1000"></div>
            </div>
        </div>
        <footer class="footer">
            <div class="container" style="text-align: center">
                <p class="text-muted">
                Copyright 2017-2018 &copy; NTNU CSIE BIOINFORMATICS
                </p>
            </div>
        </footer>
        <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
    </body>
</html>
