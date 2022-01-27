import { Theme, Breakpoint, Paper, Container } from '@mui/material';
import { styled } from '@mui/styles';
import { CreateCSSProperties } from '@mui/styles/withStyles';

export const StyledAppFlexDiv = styled('div')(() => {
  return { display: 'flex' };
});

export const StyledAppApiLoading = styled('div')({
  'text-align': 'center',
});

export const StyledAppContent = styled('main')({
  flexGrow: 1,
  flexFlow: 'row wrap',
  height: '100vh',
  overflow: 'auto'
});

export const StyledAppBarSpacer = styled('div')(({ theme }: { theme: Theme }) => {
  return (theme.mixins.toolbar as CreateCSSProperties);
});

export const StyledAppPaper = styled(Paper)(({ theme }: { theme: Theme }) => {
  return {
    padding: theme.spacing(2),
    overflow: 'auto',
    maxWidth: 'none'
  };
});

interface ContainerWrapperProps {
  children: JSX.Element | JSX.Element[],
  className: string
}
const ContainerWrapper = (props: ContainerWrapperProps): JSX.Element => {
  return (
    <Container className={props.className}>{props.children}</Container >
  );
}

export const StyledContainer = styled(ContainerWrapper)(({ theme }: { theme: Theme }) => {
  return {
    padding: theme.spacing(2),
    marginLeft: 0,
    maxWidth: '1920px',
  }
});

export const StyledAppContainer = styled(ContainerWrapper)(({ theme }: { theme: Theme }) => {
  return {
    padding: theme.spacing(2),
    marginLeft: 0,
  }
});
