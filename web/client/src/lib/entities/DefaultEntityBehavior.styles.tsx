
import { styled } from '@mui/styles';
import { Typography, Grid } from '@mui/material';

export const StyledGroupLegend = styled(
    (props) => {
        const { children, className } = props;
        return (<Typography variant='h6' color='inherit' gutterBottom className={className}>{children}</Typography>);
    }
)(
    () => {
        return {
            marginBottom: '40px',
            paddingBottom: '10px',
            borderBottom: '1px solid #aaa',
        }
    }
);

export const StyledGroupGrid = styled(
    (props) => {
        const { children, className } = props;
        return (<Grid container spacing={3} className={className}>{children}</Grid>);
    }
)(
    () => {
        return {
            paddingLeft: '15px',
            marginBottom: '15px',
        }
    }
);

