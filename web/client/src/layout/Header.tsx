import {
  makeStyles, AppBar, Toolbar
} from '@material-ui/core';
import CollapsedBreadcrumbs from './CollapsedBreadcrumbs';

interface headerProps {
  loggedIn: boolean
}

export default function Header(props: headerProps) {

  const classes = useStyles();
  const { loggedIn } = props;

  return (
    <div className={classes.root}>
      <AppBar position="absolute" className={classes.appBar}>
        <Toolbar className={classes.toolbar}>
          {loggedIn && <CollapsedBreadcrumbs />}
        </Toolbar>
      </AppBar>
    </div>
  );
}

const useStyles = makeStyles((theme:any) => ({
  root: {
    display: 'flex',
  },
  toolbar: theme.mixins.toolbar,
  appBar: {
    zIndex: theme.zIndex.drawer + 1,
    transition: theme.transitions.create(['width', 'margin'], {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.leavingScreen,
    }),
  }
}));
