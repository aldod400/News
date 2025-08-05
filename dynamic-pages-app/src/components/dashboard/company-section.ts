import React from 'react';
import { Link } from 'react-router-dom';

const CompanySection = () => {
    return (
        <div className="company-section">
            <h2>Company</h2>
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
        </div>
    );
};

export default CompanySection;