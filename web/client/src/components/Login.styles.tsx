import { Theme, Avatar, Button } from '@mui/material';
import { styled } from '@mui/styles';

export const StyledLoginContainer = styled('div')(({ theme }: { theme: Theme }) => {
  return {
    marginTop: theme.spacing(2),
    flexDirection: 'column',
    textAlign: 'center'
  }
});

export const StyledAvatar = styled(Avatar)(({ theme }: { theme: Theme }) => {
  return {
    margin: theme.spacing(1) + ' auto',
  }
});

export const StyledForm = styled(
  (props) => {
    const { children, className, onSubmit } = props;
    return (<form onSubmit={onSubmit} className={className}>{children}</form>);
  }
)(
  ({ theme }: { theme: Theme }) => {
    return {
      width: '100%', // Fix IE 11 issue.
      marginTop: theme.spacing(1),
    }
  }
);


export const StyledSubmitButton = styled(
  (props) => {
    const { children, className, variant } = props;
    return (
      <Button type="submit" fullWidth variant={variant} className={className}>{children}</Button>
    );
  }
)(
  ({ theme }: { theme: Theme }) => {
    return {
      margin: theme.spacing(3, 0, 2),
    }
  }
);