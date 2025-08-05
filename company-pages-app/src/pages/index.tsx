import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import AdvisoryBoard from './company/advisory-board';
import PrivacyPolicy from './company/privacy-policy';
import About from './company/about';
import ContactUs from './company/contact-us';
import Dashboard from './dashboard/company';

const App = () => {
  return (
    <Router>
      <Switch>
        <Route path="/" exact component={Dashboard} />
        <Route path="/company/advisory-board" component={AdvisoryBoard} />
        <Route path="/company/privacy-policy" component={PrivacyPolicy} />
        <Route path="/company/about" component={About} />
        <Route path="/company/contact-us" component={ContactUs} />
      </Switch>
    </Router>
  );
};

export default App;