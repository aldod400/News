import React from 'react';

const Header = () => {
    return (
        <header>
            <h1>Company Name</h1>
            <nav>
                <ul>
                    <li><a href="/company/about">About</a></li>
                    <li><a href="/company/advisory-board">Advisory Board</a></li>
                    <li><a href="/company/contact-us">Contact Us</a></li>
                    <li><a href="/company/privacy-policy">Privacy Policy</a></li>
                </ul>
            </nav>
        </header>
    );
};

export default Header;