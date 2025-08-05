import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Header from './components/Layout/Header';
import Footer from './components/Layout/Footer';
import Sidebar from './components/Layout/Sidebar';
import CompanySection from './components/Dashboard/CompanySection';
import AdvisoryBoard from './components/Company/AdvisoryBoard';
import PrivacyPolicy from './components/Company/PrivacyPolicy';
import About from './components/Company/About';
import ContactUs from './components/Company/ContactUs';

const App = () => {
    return (
        <Router>
            <Header />
            <Sidebar />
            <Switch>
                <Route path="/company/advisory-board" component={AdvisoryBoard} />
                <Route path="/company/privacy-policy" component={PrivacyPolicy} />
                <Route path="/company/about" component={About} />
                <Route path="/company/contact-us" component={ContactUs} />
                <Route path="/dashboard/company" component={CompanySection} />
                <Route path="/" exact component={() => <div>Home Page</div>} />
            </Switch>
            <Footer />
        </Router>
    );
};

export default App;