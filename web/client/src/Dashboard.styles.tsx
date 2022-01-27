import { Theme } from '@mui/material';
import { styled } from '@mui/styles';
import { Link } from "react-router-dom";
import Dashboard from './Dashboard'

const StyledDashboard = styled(
    Dashboard
)(
    () => {
        return {
            '& ul': {
                listStyle: 'none',
            },
            '& ul li': {
                margin: '5px 0',
            },
            '& svg': {
                verticalAlign: 'bottom',
            }
        }
    }
);

export default StyledDashboard;

export const StyledDashboardLink = styled(
    (props) => {
        const { children, className, to } = props;
        return (<Link to={to} className={className}>{children}</Link>)
    }
)(
    ({ theme }: { theme: Theme }) => {
        return {
            'color': theme.palette.primary.dark,
            'text-decoration': 'none',
        }
    }
);