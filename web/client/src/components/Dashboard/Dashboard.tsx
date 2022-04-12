import { withRouter } from 'react-router-dom';
import { Grid, styled, Theme } from '@mui/material';
import EntityMap from '../../router/EntityMap';
import DashboardBlock from './DashboardBlock';

interface DashboardProps {
  className?: string,
}

const Dashboard = (props: DashboardProps) => {

  const { className } = props;

  return (
        <Grid container spacing={3} className={className}>
            {EntityMap.map((routeMapBlock, key: number) => {

              if (! routeMapBlock.children.length) {
                return null;
              }

              return (
                    <DashboardBlock key={key} routeMapBlock={routeMapBlock} />
              );
            })}
        </Grid>
  );
};

export default withRouter<any, any>(
  styled(Dashboard)(
    ({ theme }: { theme: Theme }) => {
      return {
        [theme.breakpoints.down('md')]: {
          '& ul': {
            'paddingInlineStart': '20px',
          },
          '& ul li.submenu li': {
            'paddingInlineStart': '40px',
          },
        },
      };
    },
  ),
);