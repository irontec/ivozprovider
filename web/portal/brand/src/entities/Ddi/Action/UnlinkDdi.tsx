import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  isSingleRowAction,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import LinkOffIcon from '@mui/icons-material/LinkOff';
import { Tooltip } from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import Ddi from '../Ddi';

const UnlinkDdi: ActionFunctionComponent = (
  props: MultiSelectActionItemProps
) => {
  const { rows, selectedValues = [], variant = 'icon' } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);

  const filteredRows = rows.filter((row) => {
    return selectedValues.includes(row.id.toString());
  });

  const entityIds = filteredRows.map((item) => item?.id);
  let disabled = true;

  if (selectedValues.length > 0) {
    disabled = false;
  }

  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });

  const apiPost = useStoreActions((actions) => {
    return actions.api.post;
  });

  const handleClickOpen = () => {
    if (disabled) {
      return;
    }
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
    setError(false);
  };

  const handleUnlink = () => {
    const payload = entityIds;
    const path = `${Ddi.path}/unlink`;
    const resp = apiPost({
      path,
      values: payload,
      contentType: 'application/json',
      silenceErrors: true,
    })
      .then(() => {
        setOpen(false);

        if (resp !== undefined) {
          setTimeout(() => {
            reload();
          });
        }
      })
      .catch(() => {
        setError(true);
      });
  };

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: _('Accept'),
      onClick: handleUnlink,
      variant: 'solid' as const,
      autoFocus: true,
    },
  ];

  const disclaimerText = _(
    'This action is irreversible. Releasing a DDI and reassigning it to the same client does not undo the action, as all links from the DDI to its subordinate elements will be lost. Releasing a DDI is equivalent to deleting a DDI and creating a new one with the same number'
  );

  return (
    <>
      <span className={disabled ? 'disabled' : ''} onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem onClick={handleClickOpen}>
            {_('Unlink DDI', { count: selectedValues.length })}
          </MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Unlink DDI', { count: selectedValues.length })}
            placement='bottom'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta disabled={disabled}>
                <LinkOffIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </span>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Unlink DDI', { count: selectedValues.length })}
          buttons={customButtons}
          keepMounted={true}
        >
          {!error && <p>{disclaimerText}</p>}
        </Modal>
      )}
    </>
  );
};

export default UnlinkDdi;
