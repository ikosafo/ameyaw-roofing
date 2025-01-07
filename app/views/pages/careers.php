<?php include ('includes/webheader.php') ?>

    <main class="main about">
        <div class="page-header page-header-bg text-left" style="background: 50%/cover #D4E1EA url('<?php echo URLROOT ?>/public/webassets/images/custom/11.jpg');">
            <div class="container">
                <h1 class="text-white"><span class="text-white">CAREERS</span>OUR COMPANY</h1>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/pages/index"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Careers</li>
                </ol>
            </div>
        </nav>

        <div class="about-section">
            <div class="container">
                <div id="ourStory">
                    <h2 class="subtitle">Join Our Team</h2>
                    <p>We are always looking for talented and passionate individuals who share our commitment to quality and innovation in roofing solutions. While we don’t have any open positions at the moment, we encourage you to check back regularly for updates.</p>
                </div>

                <div id="missionVision">
                    <h2 class="subtitle">Why Work With Us?</h2>
                    <ul class="work-benefits-list">
                        <li>
                            <strong>Dynamic Environment:</strong> Work in a fast-paced industry where your contributions make a difference.
                        </li>
                        <li>
                            <strong>Growth Opportunities:</strong> We support the growth and development of our team members.
                        </li>
                        <li>
                            <strong>Inclusive Culture:</strong> Join a workplace that values diversity, teamwork, and collaboration.
                        </li>
                        <li>
                            <strong>Commitment to Excellence:</strong> Be part of a company dedicated to delivering superior products and services.
                        </li>
                    </ul>
                </div>

                <div id="coreValues">
                    <h2 class="subtitle">Stay Connected</h2>
                    <p>If you're interested in joining our team in the future, feel free to send your CV and a brief introduction to <a href="mailto:<?= Tools::companyCareersEmail ?>"><?= Tools::companyCareersEmail ?></a>. We'll keep your information on file and contact you when a suitable opportunity arises.</p>
                </div>
                
            </div>
        </div>

    </main>

<?php include ('includes/webfooter.php') ?>   