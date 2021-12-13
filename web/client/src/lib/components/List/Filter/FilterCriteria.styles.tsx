import { Chip } from '@mui/material';
import { styled } from '@mui/styles';
import { forwardRef } from 'react';


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
      margin: '0 5px 5px',
    }
  }
);

const _ChipIcon = (props: any) => {
  const { children, className, fieldName } = props;
  return (
    <div className={className}>
      <span className='prefix'>{fieldName}</span>
      {children}
    </div>
  );
};

export const StyledChipIcon = styled(_ChipIcon)(
  () => {
    return {
      paddingLeft: '5px',
      '& .prefix': {
        display: 'inline-flex',
        paddingRight: '10px',
      }
    }
  }
);
