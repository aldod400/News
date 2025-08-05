import React from 'react';
import { Link } from 'react-router-dom';

const Header: React.FC = () => {
    return (
        <header>
            <h1>Company Pages</h1>
            <nav>
                <ul>
                    <li><Link to="/company/contact-us">Contact Us</Link></li>
                    <li><Link to="/company/advisory-board">Advisory Board</Link></li>
                    <li><Link to="/company/privacy-policy">Privacy Policy</Link></li>
                    <li><Link to="/company/about">About</Link></li>
                </ul>
            </nav>
        </header>
    );
};

export default Header;