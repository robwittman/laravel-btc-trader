import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import AppNavbar from './common/AppNavbar.js';
import AppSidebar from './common/AppSidebar.js';
import { HashRouter, Route } from 'react-router-dom';
import AccountListPage from './account/AccountListPage';

/* An example React component */
class Main extends Component {
    render() {
        return (
            <div>
                <AppNavbar></AppNavbar>
                <AppSidebar></AppSidebar>
                <div className='container'>
                    <HashRouter>
                        <Route path='/accounts' component={AccountListPage} />
                    </HashRouter>
                </div>
            </div>
        );
    }
}

export default Main;

/* The if statement is required so as to Render the component on pages that have a div with an ID of "root";
*/

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}
