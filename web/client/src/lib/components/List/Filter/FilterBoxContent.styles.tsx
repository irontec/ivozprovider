import { styled } from '@mui/styles';
import { Theme, AppBar, Typography, Toolbar } from '@mui/material';
import FilterBoxContent from './FilterBoxContent';

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

export const StyledFilterBoxContent = styled(FilterBoxContent)(
  () => {
    return {
      paddingTop: '65px',
      maxWidth: '450px'
    }
  }
);

export const StyledToolbar = styled(Toolbar)(
  () => {
    return {
      display: 'flex',
      justifyContent: 'space-between'
    }
  }
);
