<?php
session_start();

$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$sem = isset($_SESSION['sem']) ? $_SESSION['sem'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSMPS</title>
    <link rel="stylesheet" href="styles1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .container1 {
            display: flex;
            height: 78vh;
        }
        .left-side {
            width: 400px;
            border: 1px solid black;
            padding: 5px;
        }
        .left-side p {
            margin: 25px;
        }
        .right-side {
            flex: 1;
            border: 1px solid black;
            padding: 20px;
        }
        #marks {
            height: 60vh;
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
            display: none;
        }
        #marks th, #marks td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        #cgpa-div {
            display: none;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1 id="welcome">Exam</h1>
    <div class="nav">
        <a id="admitcard" href="#">Admit Card</a>
        <a href="Home.php">Back</a>
    </div>
    <div class="container1">
        <div class="left-side">
            <select name="sem" id="sem">
                <option value="">Select</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            <button onclick="getMarks()">Get Result</button>
        </div>
        <div class="right-side">
            <table id="marks">
                <thead>
                    <tr>
                        <th>Subjects</th>
                        <th>Marks Obtained</th>
                        <th>Total Marks</th>
                    </tr>
                </thead>
                <tbody id="marks-body">
                    
                </tbody>
            </table>
            <div id="cgpa-div">CGPA: <span id="cgpa-value"></span></div>
        </div>
    </div>
    <script type="text/javascript">
        var id = <?php echo json_encode($id); ?>;
        var maxSem = <?php echo json_encode($sem); ?>;
        var url = "Admit.html?id=" + id;
        document.getElementById("admitcard").href = url;

        function getMarks() {
            var semester = document.getElementById('sem').value;
            if (semester && id) {
                if (semester > maxSem) {
                    alert("Result not out for " + semester + " Semester");
                    return;
                }

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            try {
                                var response = JSON.parse(this.responseText);
                                if (response.error) {
                                    console.error(response.error);
                                    return;
                                }
                                var marks = response.marks;
                                var marksBody = document.getElementById('marks-body');
                                marksBody.innerHTML = '';

                                if (marks) {
                                    //for every sem
                                    if(semester == 1)
                                    {
                                        var subjects = {
                                            'Professional Communication': 'ProfessionalCommunication',
                                            'Engineering Chemistry': 'EngineeringChemistry',
                                            'Engineering Mathematics-I': 'EngineeringMathematics',
                                            'Basic Electronics Engineering': 'BasicElectronicsEngineering',
                                            'Environmental Science': 'EnvironmentalScience',
                                            'Fundamental of Computer and Introduction to Programming': 'FundamentalofComputerandIntroductiontoProgramming',
                                            'Chemistry Lab': 'ChemistryLab',
                                            'Basic Electronics Engineering Lab': 'BasicElectronicsEngineeringLab',
                                            'Computer Lab-I': 'ComputerLab'
                                        };
                                    }
                                    else if(semester == 2)
                                    {
                                        var subjects = {
                                            'Advanced Professional Communication': 'AdvancedProfessionalCommunication',
                                            'Engineering Physics': 'EngineeringPhysics',
                                            'Engineering Mathematics-II': 'EngineeringMathematics',
                                            'Basic Electrical Engineering': 'BasicElectricalEngineering',
                                            'Programming for Problem Solving': 'ProgrammingforProblemSolving',
                                            'Healthy Living and Fitness': 'HealthyLivingandFitness',
                                            'Physics Lab': 'PhysicsLab',
                                            'Basic Electrical Engineering Lab': 'BasicElectricalEngineeringLab',
                                            'Computer Lab-II': 'ComputerLab'
                                        };
                                    }
                                    else if(semester == 3)
                                    {
                                        var subjects = {
                                            'Logic Design': 'LogicDesign',
                                            'Data Structures with C': 'DataStructureswithC',
                                            'Object Oriented Programming with C++': 'ObjectOrientedProgrammingwithCpp',
                                            'Discrete Structures and Combinatorics': 'DiscreteStructuresandCombinatorics',
                                            'Career': 'CareerSkills',
                                            'Elective': 'Elective',
                                            'Logic Design Lab': 'LogicDesignLab',
                                            'Data Structures Lab': 'DataStructuresLab',
                                            'OOPS with C++ Lab': 'OOPSwithCppLab'
                                        };
                                    }
                                    else if(semester == 4)
                                    {
                                        var subjects = {
                                            'Finite Automata and Formal Languages': 'FiniteAutomataandFormalLanguages',
                                            'Microprocessors': 'Microprocessors',
                                            'Java Programming Language': 'JavaProgrammingLanguage',
                                            'Design and Analysis of Algorithms': 'DesignandAnalysisofAlgorithms',
                                            'Career Skills': 'CareerSkills',
                                            'Elective': 'Elective',
                                            'Java Programming Lab': 'JavaProgrammingLab',
                                            'Microprocessors Lab': 'MicroprocessorsLab',
                                            'DAA Lab': 'DAALab'
                                        };
                                    } 
                                    else if(semester == 5)
                                    {
                                        var subjects = {
                                            'System Software': 'SystemSoftware',
                                            'Operating System': 'OperatingSystem',
                                            'Data Base Management Systems': 'DataBaseManagementSystems',
                                            'Computer Based Numerical and Statistical Techniques': 'ComputerBasedNumericalandStatisticalTechniques',
                                            'Career Skills': 'CareerSkills',
                                            'Elective': 'Elective',
                                            'Operating Systems Lab': 'OperatingSystemsLab',
                                            'DBMS Lab': 'DBMSLab',
                                            'CBNST Lab': 'CBNSTLab'
                                        };
                                    }
                                    else if(semester == 6){
                                        var subjects = {
                                            'Compiler Design': 'CompilerDesign',
                                            'Software Engineering': 'SoftwareEngineering',
                                            'Computer Networks': 'ComputerNetworks',
                                            'Full Stack Web Development': 'FullStackWebDevelopment',
                                            'Career Skills': 'CareerSkills',
                                            'Elective': 'Elective',
                                            'Compiler Design Lab': 'CompilerDesignLab',
                                            'Software Engineering Lab': 'SoftwareEngineeringLab',
                                            'Full Stack Web Development Lab': 'FullStackWebDevelopmentLab'
                                        };
                                    }
                                    // else if(semester == 7)
                                    // {
                                    // }
                                    // else if(semester == 8)
                                    // {
                                    // }

                                    for (var subject in subjects) {
                                        var tr = document.createElement('tr');
                                        var subjectTd = document.createElement('td');
                                        subjectTd.innerText = subject;
                                        tr.appendChild(subjectTd);

                                        var marksTd = document.createElement('td');
                                        marksTd.innerText = marks[subjects[subject]] || 'N/A';
                                        tr.appendChild(marksTd);

                                        var totalMarksTd = document.createElement('td');
                                        totalMarksTd.innerText = '100';
                                        tr.appendChild(totalMarksTd);

                                        marksBody.appendChild(tr);
                                    }

                                    var cgpa = marks['Cgpa'];
                                    console.log(cgpa);
                                    document.getElementById('cgpa-value').innerText = cgpa;
                                    document.getElementById('cgpa-div').style.display = 'block';
                                }

                                document.getElementById('marks').style.display = 'table';
                            } catch (e) {
                                console.error("Invalid JSON response");
                                console.error(this.responseText);
                            }
                        } else {
                            console.error("Request failed with status: " + this.status);
                            console.error(this.responseText);
                        }
                    }
                };
                xhttp.open("GET", "getMarks.php?sem=" + semester, true);
                xhttp.send();
            } else {
                document.getElementById("marks").style.display = 'none';
                document.getElementById('cgpa-div').style.display = 'none';
            }
        }
    </script>
</body>
</html>

