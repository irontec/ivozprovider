import { withRouter } from "react-router-dom";
import { Grid } from "@mui/material";
import _ from 'lib/services/translations/translate';
import { StyledDashboardLink } from './Dashboard.styles';
import entities from './entities/index';

const Dashboard = () => {

    return (
        <Grid container spacing={3}>
            <Grid item xs={6}>
                <ul>
                    <li>
                        <StyledDashboardLink to={entities.User.path}>
                            {entities.User.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={entities.Terminal.path}>
                            {entities.Terminal.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={entities.Extension.path}>
                            {entities.Extension.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={entities.Ddi.path}>
                            {entities.Ddi.title}
                        </StyledDashboardLink>
                    </li>
                    <li className="submenu">
                        <h3>{_('Routing endpoints')}</h3>
                        <div>
                            <ul>
                                <li>
                                    <StyledDashboardLink to={entities.Ivr.path}>
                                        {entities.Ivr.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.HuntGroup.path}>
                                        {entities.HuntGroup.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.Queue.path}>
                                        {entities.Queue.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.ConditionalRoute.path}>
                                        {entities.ConditionalRoute.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.Friend.path}>
                                        {entities.Friend.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.ConferenceRoom.path}>
                                        {entities.ConferenceRoom.title}
                                    </StyledDashboardLink>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li className="submenu">
                        <h3>{_('Routing tools')}</h3>
                        <div>
                            <ul>
                                <li>
                                    <StyledDashboardLink to={entities.ExternalCallFilter.path}>
                                        {entities.ExternalCallFilter.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.Calendar.path}>
                                        {entities.Calendar.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.Schedule.path}>
                                        {entities.Schedule.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.MatchList.path}>
                                        {entities.MatchList.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.RouteLock.path}>
                                        {entities.RouteLock.title}
                                    </StyledDashboardLink>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </Grid>
            <Grid item xs={6}>
                <ul>
                    <li className="submenu">
                        <h3>{_('User configuration')}</h3>
                        <div>
                            <ul>
                                <li>
                                    <StyledDashboardLink to={entities.OutgoingDdiRule.path}>
                                        {entities.OutgoingDdiRule.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.PickUpGroup.path}>
                                        {entities.PickUpGroup.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.CallAcl.path}>
                                        {entities.CallAcl.title}
                                    </StyledDashboardLink>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li className="submenu">
                        <h3>{_('Multimedia')}</h3>
                        <div>
                            <ul>
                                <li>
                                    <StyledDashboardLink to={entities.Locution.path}>
                                        {entities.Locution.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.MusicOnHold.path}>
                                        {entities.MusicOnHold.title}
                                    </StyledDashboardLink>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <StyledDashboardLink to={entities.Fax.path}>
                            {entities.Fax.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={entities.CompanyService.path}>
                            {entities.CompanyService.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={entities.RatingProfile.path}>
                            {entities.RatingProfile.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        Invoices
                    </li>
                    <li className="submenu">
                        <h3>{_('Calls')}</h3>
                        <div>
                            <ul>
                                <li>
                                    Active calls
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.UsersCdr.path}>
                                        {entities.UsersCdr.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.BillableCall.path}>
                                        {entities.BillableCall.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.CallCsvScheduler.path}>
                                        {entities.CallCsvScheduler.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={entities.Recording.path}>
                                        {entities.Recording.title}
                                    </StyledDashboardLink>
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