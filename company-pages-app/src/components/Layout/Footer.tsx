import React from 'react';

const Footer: React.FC = () => {
    return (
        <footer>
            <div className="footer-content">
                <p>&copy; {new Date().getFullYear()} Company Name. All rights reserved.</p>
                <nav>
                    <ul>
                        <li><a href="/company/about">About</a></li>
                        <li><a href="/company/privacy-policy">Privacy Policy</a></li>
                        <li><a href="/company/advisory-board">Advisory Board</a></li>
                        <li><a href="/company/contact-us">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </footer>
    );
};

export default Footer;