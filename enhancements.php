<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Check out all the cool enhancements that are made to CourseNation's stunning website!" />
    <meta name="keyword" content="CourseNation, Website Enhancements, Responsive Website, Cool HTML Elements, Cool CSS Properties" />
    <meta name="author" content="Karan Manoj Shah" />

    <title>Enhancements | CourseNation</title>
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
        <h1>Enhancements Made to CourseNation Website</h1>
        <section class="enhancements">
            <h2>Responsive Website</h2>
            <ul>
                <li>I have gone beyong the basic requirements of this website by designing and styling this website so that it provides optimal view when viewed on different devices, including PC/Laptops, Tablets, and Mobile Phones.</li>
                <li>I achieved this by creating a new stylesheet "responsive.css" and using the <code>@media</code> rule to specify unique styling on screens of different widths. Using <code>@media screen and (max-width: 500px)</code> I have provided unique styling for phone displays, while Using <code>@media screen and (max-width: 1000px) and (min-width: 501px)</code> I added styling for tablet-sized screens.</li>
                <li>While I didn't source this content from anywhere (I coded it myself), I did take some reference from <a href="https://www.w3schools.com/cssref/css3_pr_mediaquery.asp" target="_blank">W3Schools @media Rule</a> page.</li>
                <li>While every page of this website has been made responsive, if you're looking for specific examples, you can:
                    <ul>
                        <li>Open any page on the website in mobile phone view and see how the header and navigation elements of the page change. Notice the addition of right-side borders on all odd nav elements, how the paragraph in the header disappears, among other styling changes to make the navigation more convenient on mobile devices.</li>
                        <li>go to the <a href="product.php">Products Page</a> and view the screen in tablet resolution and then phone resolution. You'll notice that the aside tag doesn't float but instead seamlessly integrates with the content, as floating to the right on a smaller screen is a decoratively or structually acceptable design. Similarly, all other aspects of the webpage have been styled uniquely for different screen sizes.</li>
                        <li>visit the <a href="index.php">Home Page</a> and notice how the translucent content panel over the background image is styled differently for phones and tablets, making them easier to use and more appealing to the eye. Even the button in the content panel have different styling!</li>
                        <li>view the <a href="about.php">About Page</a> and see how the figure element and the embed element (where you can see the PDF) get different styling on phones, tablets, and PC-sized displays.</li>
                    </ul>
                </li>
            </ul>
        </section>
        <section class="enhancements">
            <h2>Distinct HTML Elements & CSS Properties</h2>
            <p>This section describes the various HTML elements and CSS properties I've used in this website which were not taught to us, and which significantly enhance the website's structuring and design:</p>
            <ol>
                <li>HTML: the image map tag, details tag, summary tag, and embed tag</li>
                <li>CSS: column-count, column-fill, column-gap, and column-span properties</li>
            </ol>
            <h3>Image Map</h3>
            <ul>
                <li>I have gone beyond the basic requirements of this website by adding an image map element, wherein clicking on specific areas within the image links the user to a specific repository on Github to display my programming portfolio samples based on which programming language's icon is clicked upon.</li>
                <li>To implement an image map, a <code>map</code> element has to be defined with a <code>name</code> attribute. To the image on which map is to be applied, the <code>usemap</code> attribute must be applied, whose value must be '#' followed by the value of the name attribute of the <code>map</code> element, example <code>name="#programming_map"</code>. Now, within the map element, we can create areas using the <code>area</code> tag. Each area can be a circle, square, or a quadrilateral. We must specify the coordinates of where we want to position these areas on the image using the <code>coord</code> attribute, then use the <code>href</code> attribute to specify where to link the area. It's also good practice to use the <code>alt</code> attribute in the <code>area</code> element.</li>
                <li>I learnt how to use the image map from <a href="https://html.com/images/how-to-make-an-image-map/" target="_blank">a tutorial on HTML.com</a>.</li>
                <li>The Image Map is located in <a href="about.php#programming">Programming Skills section of About Page</a>.</li>
            </ul>
            <h3>Expandable/Collapsible Contents</h3>
            <ul>
                <li>I have gone beyond the basic requirements of this website by creating certain content blocks on the Products and About page that can be expanded/collapsed so that the user can view only the content they are interested in the the length of the page remains short, as is a good website design principle. The user can click on the header of the collapsed content to expand/re-collapse it.</li>
                <li>To create content that can be expanded or collapsed, we use the <code>details</code> tag and <code>summary</code> tag in HTML. The summary tag is a child element of the details tag, and this is the only content visible when the content is not expanded. When it is expanded, the rest of the content within the details tag (including the summary tag) become visible. Styling in CSS has allowed me to give colors and decoration to the summary tag so that it looks like a header to the other details within the expandible content.</li>
                <li>I learnt how to use the details and source tags from <a href="https://www.geeksforgeeks.org/html-5-summary-tag" target="_blank">GeeksForGeeks</a>.</li>
                <li>The Expandable/Collapsible contents are located in:
                    <ul>
                        <li><a href="product.php#courses">Courses section of Product Page</a>.</li>
                        <li><a href="about.php#timetable">Timetable section of About Page</a>.</li>
                    </ul>
                </li>
            </ul>
            <h3>Columned Lists</h3>
            <ul>
                <li>I have gone beyong the basic requirements of this website by not just listing down the product information, but also applying appropriate presentation on the list to make it more readible and structually sound. I did this by splitting the many list items of each coures into columns of equal width and height. On tablet screens, these become just 2 columns due to width restrictions, while on mobile devices these reflow into a single column.</li>
                <li>I achieved columned listing by using the CSS properties of <code>column-count</code> which defines how many columns the list must be split in, <code>column-fill</code> which specifies how the content must be distributed within columns, <code>column-span</code> which controls whether and how can content span in and across columns, and <code>column-gap</code> which specifies the gap between the columns.</li>
                <li>I explored the CSS columns properties on <a href="https://www.myprogrammingtutorials.com/unordered-list-into-multiple-columns.html" target="_blank">My Programming Tutorials</a> website.</li>
                <li>The columned lists can be viewed by expanding the collapsible content on <a href="product.php#courses">Courses section of Products Page</a>.</li>
            </ul>
            <h3>In-Page PDF Viewer</h3>
            <ul>
                <li>I have gone beyong the basic requirements of this website by not just providing basic information about me within the about page, but also displaying my resume as a PDF within the webpage. This way, the user can be in the website while also exploring my resume in the embedded window that shows the PDF. This window is scrollable and interactive.</li>
                <li>I created the In-Page PDF Viewer using the <code>embed</code> tag. I stored the resume PDF file (about 88kb file size) in the documents directory of this website, and the <code>embed</code> tag use the <code>src</code> attribute to locate the PDF which is then displayed as an In-Page interactive PDF viewer. I styled it with CSS to ensure that it structures well on the page when the figure element on the About Page is floating, and when the page reflows and goes into mobile/tablet view, the PDF viewer adjusts accordingly to provide optimum structuring and design.</li>
                <li>I learnt how to embed PDFS in HTML on <a href="https://www.codexworld.com/embed-pdf-document-file-in-html-web-page/" target="_blank">CodexWorld</a> website.</li>
                <li>The in-page PDF file can be viewed on <a href="about.php#resume">Resume section of About Page</a>.</li>
            </ul>
        </section>
    </article>
    <!-- Footer -->
    <?php include "includes/footer.inc" ?>
</body>
</html>
