import { Theme } from '@mui/material';
import { styled } from '@mui/styles';
import { Link } from "react-router-dom";

const StyledDashboardLink = styled(
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

export default StyledDashboardLink;