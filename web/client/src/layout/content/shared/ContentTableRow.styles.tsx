import { Theme, TableCell } from '@mui/material';
import { styled } from '@mui/styles';
import { Link } from "react-router-dom";
import DeleteIcon from '@mui/icons-material/Delete';
import CheckBoxIcon from '@mui/icons-material/CheckBox';
import CheckBoxOutlineBlankIcon from '@mui/icons-material/CheckBoxOutlineBlank';

const linkSharedStyles = {
  color: 'inherit',
  cursor: 'pointer',
};

export const StyledTableRowLink = styled(
  (props) => {
    const { children, className, to } = props;
    return (<Link to={to} className={className}>{children}</Link>);
  }
)(
  ({ theme }: { theme: Theme }) => {
    return {
      ...linkSharedStyles,
      textDecoration: 'none',
    };
  }
);

export const StyledTableRowFkLink = styled(
  (props) => {
    const { children, className, to } = props;
    return (<Link to={to} className={className}>{children}</Link>);
  }
)(
  ({ theme }: { theme: Theme }) => {
    return linkSharedStyles;
  }
);

export const StyledDeleteIcon = styled(
  (props) => {
    const { className, onClick } = props;
    return (<DeleteIcon className={className} onClick={onClick} />);
  }
)(
  ({ theme }: { theme: Theme }) => {
    return linkSharedStyles;
  }
);

export const StyledCheckBoxIcon = styled(CheckBoxIcon)(
  ({ theme }: { theme: Theme }) => {
    return {
      color: '#aaa'
    };
  }
);

export const StyledCheckBoxOutlineBlankIcon = styled(CheckBoxOutlineBlankIcon)(
  ({ theme }: { theme: Theme }) => {
    return {
      color: '#aaa'
    };
  }
);

export const StyledTableCell = styled(
  (props) => {
    const { children, className, key } = props;
    return (<TableCell key={key} className={className}>{children}</TableCell>);
  }
)(
  ({ theme }: { theme: Theme }) => {
    return {
      textAlign: 'right'
    };
  }
);
