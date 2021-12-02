import React from 'react';
import {
  Button, IconButton, Slide, Tooltip
} from '@mui/material';
import CloseIcon from '@mui/icons-material/Close';
import { TransitionProps } from '@mui/material/transitions/transition';
import _ from 'lib/services/translations/translate';
import { StyledToolbar } from './FilterBoxContent.styles';

const Transition = React.forwardRef<unknown, TransitionProps>((props: any, ref) => {
  return <Slide direction="up" ref={ref} {...props} />;
});
Transition.displayName = 'FilterDialogTransition';

export interface FilterDialogContentProps {
  className?: string,
  handleClose: (event: unknown) => void,
  apply: (event: unknown) => void,
  children: Array<JSX.Element | null> | JSX.Element | null
}

export default function FilterBoxContent(props: FilterDialogContentProps): JSX.Element {

  const { handleClose, apply, className } = props;

  return (
    <div className={className}>
      <StyledToolbar>
        <IconButton edge="start" color="inherit" onClick={handleClose} aria-label="close">
          <Tooltip title={_('Close')} arrow placement='right'>
            <CloseIcon />
          </Tooltip>
        </IconButton>
        <Button autoFocus color="inherit" onClick={apply}>
          {_('Apply')}
        </Button>
      </StyledToolbar>
      {props.children}
    </div>
  );
}
