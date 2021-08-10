import { withRouter } from "react-router-dom";
import { makeStyles } from '@material-ui/core';
import entities from '../../entities/index';
import { Link } from "react-router-dom";
import { Grid } from "@material-ui/core";
import _ from 'services/Translations/translate';

interface dashboardProps {
}

const Dashboard = (props:dashboardProps) => {

  const classes = useStyles();

  return (
    <Grid container spacing={3}>
        <Grid item xs={6}>
            <ul>
                <li>
                    <Link to={entities.User.path} className={classes.link}>
                        {entities.User.title}
                    </Link>
                </li>
                <li>
                    <Link to={entities.Terminal.path} className={classes.link}>
                        {entities.Terminal.title}
                    </Link>
                </li>
                <li>
                    <Link to={entities.Extension.path} className={classes.link}>
                        {entities.Extension.title}
                    </Link>
                </li>
                <li>
                    <Link to={entities.Ddi.path} className={classes.link}>
                        {entities.Ddi.title}
                    </Link>
                </li>
                <li className="submenu">
                    <h3>{_('Routing endpoints')}</h3>
                    <div>
                        <ul>
                            <li>
                                <Link to={entities.Ivr.path} className={classes.link}>
                                    {entities.Ivr.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.HuntGroup.path} className={classes.link}>
                                    {entities.HuntGroup.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.Queue.path} className={classes.link}>
                                    {entities.Queue.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.ConditionalRoute.path} className={classes.link}>
                                    {entities.ConditionalRoute.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.Friend.path} className={classes.link}>
                                    {entities.Friend.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.ConferenceRoom.path} className={classes.link}>
                                    {entities.ConferenceRoom.title}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li className="submenu">
                    <h3>{_('Routing tools')}</h3>
                    <div>
                        <ul>
                            <li>
                                <Link to={entities.ExternalCallFilter.path} className={classes.link}>
                                    {entities.ExternalCallFilter.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.Calendar.path} className={classes.link}>
                                    {entities.Calendar.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.Schedule.path} className={classes.link}>
                                    {entities.Schedule.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.MatchList.path} className={classes.link}>
                                    {entities.MatchList.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.RouteLock.path} className={classes.link}>
                                    {entities.RouteLock.title}
                                </Link>
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
                                <Link to={entities.OutgoingDdiRule.path} className={classes.link}>
                                    {entities.OutgoingDdiRule.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.PickUpGroup.path} className={classes.link}>
                                    {entities.PickUpGroup.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.CallAcl.path} className={classes.link}>
                                    {entities.CallAcl.title}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li className="submenu">
                    <h3>{_('Multimedia')}</h3>
                    <div>
                        <ul>
                            <li>
                                <Link to={entities.Locution.path} className={classes.link}>
                                    {entities.Locution.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.MusicOnHold.path} className={classes.link}>
                                    {entities.MusicOnHold.title}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <Link to={entities.Fax.path} className={classes.link}>
                        {entities.Fax.title}
                    </Link>
                </li>
                <li>
                    <Link to={entities.Service.path} className={classes.link}>
                        {entities.Service.title}
                    </Link>
                </li>
                <li>
                    <Link to={entities.RatingProfile.path} className={classes.link}>
                        {entities.RatingProfile.title}
                    </Link>
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
                                <Link to={entities.UsersCdr.path} className={classes.link}>
                                    {entities.UsersCdr.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.BillableCall.path} className={classes.link}>
                                    {entities.BillableCall.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.CallCsvScheduler.path} className={classes.link}>
                                    {entities.CallCsvScheduler.title}
                                </Link>
                            </li>
                            <li>
                                <Link to={entities.Recording.path} className={classes.link}>
                                    {entities.Recording.title}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </Grid>
    </Grid>
  );
};


const useStyles = makeStyles((theme: any) => {
    return ({
        link: {
        'color': theme.palette.primary.dark,
        'text-decoration': 'none',
        },
    })
});

export default withRouter<any, any>(Dashboard);