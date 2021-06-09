import React from 'react';
import { Link } from "react-router-dom";
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';

const DashboardLongCard = (props:any) => {

  const { menuItem } = props;
  const classes = useStyles();

  return (
    <React.Fragment>
      <Card className={classes.card}>
          <div>
          <CardContent className={classes.cardContent}>
            <div className={classes.contentLeft}>
              <Link to={menuItem.path} className={classes.link}>
                { menuItem.icon }
                <Typography color="textSecondary" gutterBottom>
                  {menuItem.title}
                </Typography>
              </Link>
            </div>
            {props.children}
          </CardContent>
          </div>
      </Card>
    </React.Fragment>
  );
};

export default DashboardLongCard;

const useStyles = makeStyles({
  card: {
    width: '100%',
    margin: '10px',
  },
  cardContent: {
    display: 'flex',
    padding: '16px 5px',
  },
  link: {
    color: 'inherit',
    textDecoration: 'none'
  },
  contentLeft: {
    display: 'block',
    textAlign: 'center',
    margin: '15px',
    width: '145px',
  }
});