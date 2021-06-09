import React from 'react';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import { makeStyles } from '@material-ui/core/styles';

const DashboardCard = (props:any) => {

  const { children } = props;
  const classes = useStyles();

  return (
    <React.Fragment>
      <Card className={classes.card}>
          <CardContent className={classes.cardContent}>
            {children}
          </CardContent>
      </Card>
    </React.Fragment>
  );
};

export default DashboardCard;

const useStyles = makeStyles({
  card: {
    width: '100%',
    margin: '10px',
    textAlign: 'center',
  },
  cardContent: {
    padding: '16px 5px',
  },
  link: {
    color: 'inherit',
    textDecoration: 'none'
  }
});