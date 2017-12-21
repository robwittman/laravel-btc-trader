import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import AppNavbar from './common/AppNavbar.js';
import AppSidebar from './common/AppSidebar.js';
import { HashRouter, Route } from 'react-router-dom';
import AccountListPage from './account/AccountListPage';

/* An example React component */
class Main extends Component {
    componentDidMount() {
        this.ws = new WebSocket('wss://ws-feed.gdax.com');
        this.ws.onopen = e => {
            this.ws.send(
                JSON.stringify({
                type: 'subscribe',
                product_ids: [
                    'BTC-USD',
                    'ETH-USD',
                    'LTC-USD'
                ],
                'channels': [
                    'ticker',
                    'heartbeat'
                ]
            }));
        }
        this.ws.onmessage = e => console.log(e);
        this.ws.onerror = e => console.log(e);
        this.ws.onclose = e => console.log(e);
        console.log(this.ws);
    }
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
