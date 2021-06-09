import { withRouter } from "react-router-dom";
import entities from '../../entities/index';
import { Link } from "react-router-dom";
import { Grid } from "@material-ui/core";

interface dashboardProps {
}

const Dashboard = (props:dashboardProps) => {

  return (
    <Grid container spacing={3}>
        <Grid item xs={6}>
            <ul>
                <li>
                    Users
                </li>
                <li>
                    <Link to={entities.Terminal.path}>
                    {entities.Terminal.title}
                    </Link>
                </li>
                <li>
                    Extensions
                </li>
                <li>
                    DDIs
                </li>
                <li className="submenu">
                    <h3>Routing endpoints</h3>
                    <div>
                        <ul>
                            <li>
                                IVRs
                            </li>
                            <li>
                                Hunt Groups
                            </li>
                            <li>
                                Queues
                            </li>
                            <li>
                                Conditional Routes
                            </li>
                            <li>
                                Friends
                            </li>
                            <li>
                                Conference rooms
                            </li>
                        </ul>
                    </div>
                </li>
                <li className="submenu">
                    <h3>Routing tools</h3>
                    <div>
                        <ul>
                            <li>
                                External call filters
                            </li>
                            <li>
                                Calendars
                            </li>
                            <li>
                                Schedules
                            </li>
                            <li>
                                Match Lists
                            </li>
                            <li>
                                Route Locks
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </Grid>
        <Grid item xs={6}>
            <ul>
                <li className="submenu">
                    <h3>User configuration</h3>
                    <div>
                        <ul>
                            <li>
                                Outgoing DDI Rules
                            </li>
                            <li>
                                Pick up groups
                            </li>
                            <li>
                                Call ACLs
                            </li>
                        </ul>
                    </div>
                </li>
                <li className="submenu">
                    <h3>Multimedia</h3>
                    <div>
                        <ul>
                            <li>
                                Locutions
                            </li>
                            <li>
                                Music on Hold
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    Faxes
                </li>
                <li>
                    Services
                </li>
                <li>
                    Rating Profiles
                </li>
                <li>
                    Invoices
                </li>
                <li className="submenu">
                    <h3>Calls</h3>
                    <div>
                        <ul>
                            <li>
                                Active calls
                            </li>
                            <li>
                                Call registry
                            </li>
                            <li>
                                External calls
                            </li>
                            <li>
                                Call CSV schedulers
                            </li>
                            <li>
                                Call recordings
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </Grid>
    </Grid>

  );
};

export default withRouter<any, any>(Dashboard);