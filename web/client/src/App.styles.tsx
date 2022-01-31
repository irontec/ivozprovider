import { Theme, Paper, Container } from '@mui/material';
import { styled } from '@mui/styles';

export const StyledAppFlexDiv = styled('div')(() => {
  return {
    maxWidth: '1920px',
  };
});

export const StyledAppApiLoading = styled('div')({
  'text-align': 'center',
});

export const StyledAppContent = styled('main')({
  flexGrow: 1,
  flexFlow: 'row wrap',
  overflow: 'auto',
});

export const StyledAppPaper = styled(
  (props:any): JSX.Element => {
    return (
      <Paper elevation={1}>{props.children}</Paper >
    );
  }
)(
  ({ theme }: { theme: Theme }) => {
    return {
      padding: theme.spacing(2),
      overflow: 'auto',
      maxWidth: 'none'
    };
  }
);

interface ContainerWrapperProps {
  children: JSX.Element | JSX.Element[],
  className: string
}
const ContainerWrapper = (props: ContainerWrapperProps): JSX.Element => {
  return (
    <Container maxWidth={false} className={props.className}>{props.children}</Container >
  );
}

export const StyledContainer = styled(ContainerWrapper)(({ theme }: { theme: Theme }) => {
  return {
    padding: theme.spacing(2),
    marginLeft: 0,
  }
});

export const StyledAppContainer = styled(ContainerWrapper)(({ theme }: { theme: Theme }) => {
  return {
    padding: theme.spacing(2),
    marginLeft: 0,
  }
});
