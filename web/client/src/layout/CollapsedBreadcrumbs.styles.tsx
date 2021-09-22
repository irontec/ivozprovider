import { Link } from "react-router-dom";
import NavigateNextIcon from '@mui/icons-material/NavigateNext';
import HomeIcon from '@mui/icons-material/Home';
import { Theme, Typography } from '@mui/material';
import { CreateCSSProperties, styled } from '@mui/styles';

const linkStyles: CreateCSSProperties = {
  textDecoration: 'none',
  display: 'flex',
  color: 'white',
};

export const StyledCollapsedBreadcrumbsLink = styled(
  (props) => {
    const { className, children, to, ...rest } = props;
    return (<Link className={className} to={to} {...rest}>{props.children}</Link>);
  }
)(
  () => {
    return {
      ...linkStyles,
    }
  }
);

export const StyledCollapsedBreadcrumbsTypography = styled(
  (props) => {
    const { className, children, ...rest } = props;
    return (<Typography className={className} {...rest}>{children}</Typography>);
  }
)(
  () => {
    return {
      ...linkStyles,
    }
  }
);

export const StyledCollapsedBreadcrumbsNavigateNextIcon = styled(
  (props) => {
    const { className } = props;
    return (<NavigateNextIcon fontSize='small' className={className} />);
  }
)(
  () => {
    return {
      ...linkStyles,
    }
  }
);

export const StyledHomeIcon = styled(HomeIcon)(
  ({ theme }: { theme: Theme }) => {
    return {
      marginRight: theme.spacing(0.5),
      width: 25,
      height: 25,
    }
  }
);
