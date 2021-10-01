import { Theme, Card, CardContent } from '@mui/material';
import { styled } from '@mui/styles';
import { Link } from "react-router-dom";

export const StyledCard = styled(Card)(
  ({ theme }: { theme: Theme }) => {
    return {
      width: '100%',
      margin: '10px',
    }
  }
);

export const StyledCardContent = styled(CardContent)(
  ({ theme }: { theme: Theme }) => {
    return {
      display: 'flex',
      padding: '16px 5px',
    }
  }
);

export const StyledDivContentLeft = styled('div')(
  ({ theme }: { theme: Theme }) => {
    return {
      display: 'block',
      textAlign: 'center',
      margin: '15px',
      width: '145px',
    }
  }
);

export const StyledLink = styled(
  (props) => {
    const { children, className, to } = props;
    return (<Link to={to} className={className}>{children}</Link>);
  }
)(
  ({ theme }: { theme: Theme }) => {
    return {
      color: 'inherit',
      textDecoration: 'none'
    }
  }
);