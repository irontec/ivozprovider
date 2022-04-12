import { Theme, Container } from '@mui/material';
import { CreateCSSProperties, styled } from '@mui/styles';

export const StyledAppContent = styled('main')({
  flexGrow: 1,
  flexFlow: 'row wrap',
  overflow: 'auto',
  height: '100vh',
});

export const StyledAppBodyContainer = styled(
  (props: any): JSX.Element => {

    const { className } = props;

    return (
      <div className={className}>{props.children}</div>
    );
  },
)(
  ({ theme }: { theme: Theme }) => {
    return {
      padding: theme.spacing(2),
      overflow: 'auto',
      maxWidth: 'none',
      borderBottom: '1px solid #ccc',
    };
  },
);

interface ContainerWrapperProps {
  children: JSX.Element | JSX.Element[],
  className: string
}
const ContainerWrapper = (props: ContainerWrapperProps): JSX.Element => {
  return (
    <Container maxWidth={false} className={props.className}>{props.children}</Container >
  );
};

export const StyledContainer = styled(ContainerWrapper)(({ theme }: { theme: Theme }) => {
  return {
    padding: theme.spacing(2),
    marginLeft: 0,
  };
});

export const StyledAppBarSpacer = styled('div')(({ theme }: { theme: Theme }) => {
  return (theme.mixins.toolbar as CreateCSSProperties);
});
