/* eslint-disable jsx-a11y/anchor-is-valid */
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import Typography from '@material-ui/core/Typography';
import { Link, useLocation } from "react-router-dom";
import { makeStyles, Theme } from '@material-ui/core';
import HomeIcon from '@material-ui/icons/Home';
import NavigateNextIcon from '@material-ui/icons/NavigateNext';
import { useStoreState } from 'easy-peasy';

export default function CollapsedBreadcrumbs() {

  const classes = useStyles();
  const location = useLocation();

  const currentRoute = useStoreState((state: any) => state.route.route);
  const routeSegments = currentRoute.split('/').filter((segment:string) => {
    return segment;
  });
  const pathSegments = location.pathname.split('/').filter((segment:string) => {
    return segment;
  });

  const parsedSegments:Array<string> = [];

  return (
    <Breadcrumbs
      maxItems={3}
      separator={<NavigateNextIcon fontSize="small" className={classes.separator} />}
      aria-label="breadcrumb"
    >
      <Link className={classes.link} to={''}>
        <HomeIcon className={classes.icon} />
      </Link>
      {routeSegments.map((segment:string, key:number) => {

        parsedSegments.push(pathSegments[key]);

        if ((/^:.+/).test(segment)) {
          return null;
        }

        const noLink =
          ['create', 'detailed', 'update'].includes(segment);

        if (noLink) {
          return (
            <Typography className={classes.link} key={key}>{segment}</Typography>
          );
        }

        const to = '/' + parsedSegments.join('/');

        return (
          <Link className={classes.link} to={to} key={key}>
            {segment}
          </Link>
        );
      })}

    </Breadcrumbs>
  );
}

const useStyles = makeStyles((theme: Theme) => ({
  link: {
    textDecoration: 'none',
    display: 'flex',
    color: 'white',
  },
  separator: {
    color: 'white',
  },
  icon: {
    marginRight: theme.spacing(0.5),
    width: 25,
    height: 25,
  }
}));
