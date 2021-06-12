<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="The about page gives information on CourseNation's founder Karan Manoj Shah and his educational details." />
    <meta name="keyword" content="About CourseNation, CourseNation Founder, Short Training Courses, Professional Training, Web Dev Course" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>About | CourseNation</title>
    <link rel="icon" href="images/icon.png" />

    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/responsive.css" />

    <script src="scripts/enhancements.js"></script>
</head>
<body>
    <!-- Header -->
    <?php include "includes/header.inc" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.inc" ?>
    <!-- Article -->
    <article>
        <h1>About</h1>
        <!-- Figure -->
        <figure>
            <img src="images/profile.jpg" alt="Karan Manoj Shah" title="Karan  Manoj Shah" />
            <figcaption>Karan M. Shah</figcaption>
        </figure>
        <!-- Profile -->
        <section id="profile">
            <h2>Profile</h2>
            <dl>
                <dt>Name</dt>
                <dd>Karan Manoj Shah</dd>
                <dt>Student ID</dt>
                <dd>103141481</dd>
                <dt>Course</dt>
                <dd>Bachelor of Computer Science (BA-CS)</dd>
                <dt>Email</dt>
                <dd><a href="mailto:103141481@student.swin.edu.au">103141481@student.swin.edu.au</a></dd>
            </dl>
            <h3 id="resume">Resume</h3>
            <!-- Embedded PDF -->
            <embed title="Karan Shah's Resume" src="documents/resume.pdf">
            <h3 id="programming">Programming Skills</h3>
            <p>Karan Shah can program in the following languages. <strong>Click on the icon of a language view Github samples!</strong></p>
            <!-- Image Map -->
            <img src="images/programming.png" alt="Programming Languages" usemap="#programming_map" />
            <map name="programming_map">
                <area shape="circle" coords="35,187,32" alt="Ruby" href="https://github.com/karanshah0206/Whack-A-Ruby">
                <area shape="circle" coords="196,32,32" alt="C" href="https://github.com/karanshah0206/PeltierCooler">
                <area shape="rect" coords="330,153,388,212" alt="JavaScript" href="https://github.com/karanshah0206/HH">
            </map>
            <p>Image sourced from <a href="https://technographx.com/4-best-programming-languages-for-web-development/" target="_blank">TechnoGraphX</a></p>
        </section>
        <!-- Timetable -->
        <section id="timetable">
            <h2>Timetable</h2>
            <details id="timetable_legend">
                <summary>Timetable Legend</summary>
                <ul>
                    <li class="cle">COS10003: Computer and Logic Essentials</li>
                    <li class="intro_to_programming">COS10009: Introduction to Programming</li>
                    <li class="web_dev">COS10011: Creating Web Applications</li>
                    <li class="net_admin">TNE10005: Network Administration</li>
                </ul>
            </details>
            <table class="timetable">
                <thead>
                    <tr>
                        <th>Timing</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th rowspan="2">8AM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="4" class="intro_to_programming">COS10009 Lab 1</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">9AM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">10AM</th>
                        <td></td>
                        <td rowspan="4" class="intro_to_programming">COS10009 Live Online</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="4" class="intro_to_programming">COS10009 Lab 2</td>
                    </tr>
                    <tr>
                        <th rowspan="2">11AM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="web_dev">COS10011 Live Online</td>
                        <td></td>
                        <td rowspan="6" class="net_admin">TNE10005 Lab 1</td>
                    </tr>
                    <tr>
                        <th rowspan="2">12PM</th>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">1PM</th>
                        <td></td>
                        <td rowspan="4" class="cle">COS10003 Live Online</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">2PM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td rowspan="4" class="cle">COS10003 Lab 1</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">3PM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">4PM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="web_dev">COS10011 Lab 1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">5PM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">6PM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="4" class="net_admin">TNE10005 Live Online</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">7PM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan="2">8PM</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
