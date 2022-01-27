import { withRouter } from "react-router-dom";
import { Grid } from "@mui/material";
import _ from 'lib/services/translations/translate';
import { StyledDashboardLink } from './Dashboard.styles';
import entities from './entities';
import ReadMoreIcon from '@mui/icons-material/ReadMore';


interface DashboardProps {
    className?: string,
}

const Dashboard = ( props: DashboardProps ) => {

    const { className } = props;

    const {
        User,
        Terminal,
        Extension,
        Ddi,
        Ivr,
        HuntGroup,
        Queue,
        ConditionalRoute,
        Friend,
        ConferenceRoom,
        ExternalCallFilter,
        Calendar,
        Schedule,
        MatchList,
        RouteLock,
        OutgoingDdiRule,
        PickUpGroup,
        CallAcl,
        Locution,
        MusicOnHold,
        Fax,
        CompanyService,
        RatingProfile,
        UsersCdr,
        BillableCall,
        CallCsvScheduler,
        Recording,
    } = entities;


    return (
        <Grid container spacing={3} className={className}>
            <Grid item md={6} xs={12}>
                <ul>
                    <li>
                        <StyledDashboardLink to={User.path}>
                            {User.icon}
                            {User.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={Terminal.path}>
                            {Terminal.icon}
                            {Terminal.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={Extension.path}>
                            {Extension.icon}
                            {Extension.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={Ddi.path}>
                            {Ddi.icon}
                            {Ddi.title}
                        </StyledDashboardLink>
                    </li>
                    <li className="submenu">
                        <h3>{_('Routing endpoints')}</h3>
                        <div>
                            <ul>
                                <li>
                                    <StyledDashboardLink to={Ivr.path}>
                                        {Ivr.icon}
                                        {Ivr.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={HuntGroup.path}>
                                        {HuntGroup.icon}
                                        {HuntGroup.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={Queue.path}>
                                        {Queue.icon}
                                        {Queue.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={ConditionalRoute.path}>
                                        {ConditionalRoute.icon}
                                        {ConditionalRoute.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={Friend.path}>
                                        {Friend.icon}
                                        {Friend.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={ConferenceRoom.path}>
                                        {ConferenceRoom.icon}
                                        {ConferenceRoom.title}
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
                                    <StyledDashboardLink to={ExternalCallFilter.path}>
                                        {ExternalCallFilter.icon}
                                        {ExternalCallFilter.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={Calendar.path}>
                                        {Calendar.icon}
                                        {Calendar.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={Schedule.path}>
                                        {Schedule.icon}
                                        {Schedule.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={MatchList.path}>
                                        {MatchList.icon}
                                        {MatchList.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={RouteLock.path}>
                                        {RouteLock.icon}
                                        {RouteLock.title}
                                    </StyledDashboardLink>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </Grid>
            <Grid item md={6} xs={12}>
                <ul>
                    <li className="submenu">
                        <h3>{_('User configuration')}</h3>
                        <div>
                            <ul>
                                <li>
                                    <StyledDashboardLink to={OutgoingDdiRule.path}>
                                        {OutgoingDdiRule.icon}
                                        {OutgoingDdiRule.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={PickUpGroup.path}>
                                        {PickUpGroup.icon}
                                        {PickUpGroup.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={CallAcl.path}>
                                        {CallAcl.icon}
                                        {CallAcl.title}
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
                                    <StyledDashboardLink to={Locution.path}>
                                        {Locution.icon}
                                        {Locution.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={MusicOnHold.path}>
                                        {MusicOnHold.icon}
                                        {MusicOnHold.title}
                                    </StyledDashboardLink>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <StyledDashboardLink to={Fax.path}>
                            {Fax.icon}
                            {Fax.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={CompanyService.path}>
                            {CompanyService.icon}
                            {CompanyService.title}
                        </StyledDashboardLink>
                    </li>
                    <li>
                        <StyledDashboardLink to={RatingProfile.path}>
                            {RatingProfile.icon}
                            {RatingProfile.title} (FORBIDEN)
                        </StyledDashboardLink>
                    </li>
                    <li className="submenu">
                        <h3>{_('Calls')}</h3>
                        <div>
                            <ul>
                                <li>
                                    <ReadMoreIcon /> Active calls
                                </li>
                                <li>
                                    <StyledDashboardLink to={UsersCdr.path}>
                                        {UsersCdr.icon}
                                        {UsersCdr.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={BillableCall.path}>
                                        {BillableCall.icon}
                                        {BillableCall.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={CallCsvScheduler.path}>
                                        {CallCsvScheduler.icon}
                                        {CallCsvScheduler.title}
                                    </StyledDashboardLink>
                                </li>
                                <li>
                                    <StyledDashboardLink to={Recording.path}>
                                        {Recording.icon}
                                        {Recording.title}
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