import { Fab, Chip } from '@mui/material';
import { styled } from '@mui/styles';
import { forwardRef } from 'react';
import { Link } from "react-router-dom";

export const StyledActionButtonContainer = styled('div')(
  () => {
    return {
      display: 'flex',
      justifyContent: 'space-between',
      '& > div:nth-child(n+1)': {
        alignContent: 'flex-end'
      }
    }
  }
);

export const StyledLink = styled(
  (props) => {
    const { children, className, to } = props;
    return (<Link to={to} className={className}>{children}</Link>);
  }
)(
  () => {
    return {
      textDecoration: 'none',
      color: 'inherit',
    }
  }
);

const _Fab = forwardRef<any, any>((props, ref) => {
  const { children, className, onClick, ...rest } = props;
  return (
    <Fab
      {...rest}
      color="secondary"
      size="small"
      variant="extended"
      className={className}
      onClick={onClick}
      ref={ref}
    >
      {children}
    </Fab>
  );
});
_Fab.displayName = '_Fab';

export const StyledFab = styled(_Fab)(
  () => {
    return {
      marginRight: '10px'
    }
  }
);

const _Chip = forwardRef<any, any>((props, ref) => {
  const { className, icon, label, onDelete } = props;
  return (
    <Chip
      icon={icon}
      label={label}
      onDelete={onDelete}
      className={className}
      ref={ref}
    />
  );
});
_Chip.displayName = '_Chip';

export const StyledChip = styled(_Chip)(
  () => {
    return {
      margin: '0 5px',
    }
  }
);

export const StyledChipIcon = styled(
  (props) => {
    const { children, className, fieldName } = props;
    return (
      <div className={className}>
        <span className='prefix'>{fieldName}</span>
        {children}
      </div>
    );
  }
)(
  () => {
    return {
      paddingTop: '5px',
      '* .prefix': {
        display: 'inline-flex',
        userSelect: 'none',
        paddingLeft: '12px',
        paddingRight: '5px',
        verticalAlign: 'super',
      }
    }
  }
);
