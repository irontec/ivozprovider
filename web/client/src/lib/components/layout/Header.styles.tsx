import { AppBar, Theme, Toolbar } from '@mui/material';
import { styled } from '@mui/styles';
import { CreateCSSProperties } from '@mui/styles/withStyles';

export const StyledHeaderContainer = styled('div')({
  display: 'flex',
});

export const StyledAppBar = styled(
  (props) => {
    const { position, className, children } = props;
    return (<AppBar position={position} className={className}>{children}</AppBar>);
  }
)(
  ({ theme }: { theme: Theme }) => {
    return {
      zIndex: theme.zIndex.drawer + 1,
      transition: theme.transitions.create(['width', 'margin'], {
        easing: theme.transitions.easing.sharp,
        duration: theme.transitions.duration.leavingScreen,
      }),
      maxWidth: '1920px',
      left: 0,
    }
  }
);

export const StyledToolbar = styled(Toolbar)(
  ({ theme }: { theme: Theme }) => {
    return theme.mixins.toolbar as CreateCSSProperties;
  }
);
