import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ReplayIcon from '@mui/icons-material/Replay';
import { Tooltip } from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import Invoice from '../Invoice';

const Regenerate: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;

  const [open, setOpen] = useState(false);
  const apiPost = useStoreActions((actions) => {
    return actions.api.post;
  });
  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });

  if (!row) {
    return null;
  }

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  const handleSend = () => {
    apiPost({
      path: `${Invoice.path}/${row.id}/regenerate`,
      values: {},
      contentType: 'text/plain',
    }).then(() => {
      setOpen(false);
      reload();
    });
  };

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: _('Send'),
      onClick: handleSend,
      variant: 'solid' as const,
      autoFocus: true,
    },
  ];

  return (
    <>
      {variant === 'text' && (
        <MoreMenuItem onClick={handleClickOpen}>
          {_('Regenerate invoice')}
        </MoreMenuItem>
      )}
      {variant === 'icon' && (
        <Tooltip
          title={_('Regenerate invoice')}
          placement='bottom-start'
          enterTouchDelay={0}
        >
          <StyledTableRowCustomCta>
            <ReplayIcon onClick={handleClickOpen} color='primary' />
          </StyledTableRowCustomCta>
        </Tooltip>
      )}
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Regenerate invoice?')}
          description={_(
            "You're about to regenerate invoice <strong>{{number}}</strong>",
            { number: row.number }
          )}
          buttons={customButtons}
        ></Modal>
      )}
    </>
  );
};

export default Regenerate;
