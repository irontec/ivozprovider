
import { styled } from '@mui/styles';
import { Theme, AppBar, Typography } from '@mui/material';

export const StyledAppBar = styled(AppBar)(
  () => {
    return {
      position: 'relative',
    }
  }
);

export const StyledFilterDialogTypography = styled(
  (props) => {
    const { children, className } = props;
    return (<Typography variant="h6" className={className}>{children}</Typography>);
  }
)(
  ({ theme }: { theme: Theme }) => {
    return {
      marginLeft: theme.spacing(2),
      flex: 1,
    }
  }
);