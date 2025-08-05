import React from 'react';
import { Link } from 'react-router-dom';

const Navigation = () => {
    return (
        <nav>
            <ul>
                <li>
                    <Link to="/company/about">About</Link>
                </li>
                <li>
                    <Link to="/company/advisory-board">Advisory Board</Link>
                </li>
                <li>
                    <Link to="/company/contact-us">Contact Us</Link>
                </li>
                <li>
                    <Link to="/company/privacy-policy">Privacy Policy</Link>
                </li>
            </ul>
        </nav>
    );
};

export default Navigation;