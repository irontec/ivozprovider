import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  OutlinedButton,
  SolidButton,
} from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import {
  ActionFunctionComponent,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CloudUploadIcon from '@mui/icons-material/CloudUpload';
import {
  Box,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  Tooltip,
} from '@mui/material';
import { styled } from '@mui/styles';
import { useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import FileUpload from '../../../components/FileUpload';
import HolidayDate from '../HolidayDate';

export const StyledDialog = styled(Dialog)(() => {
  return {
    '& .MuiPaper-root': {
      maxWidth: '90%',
    },
    '&.width .MuiPaper-root': {
      width: '90%',
    },
  };
});

const fileToBlob = (file: File): Blob => {
  return file.slice(0, file.size, file.type);
};

const Import: ActionFunctionComponent = (props: MultiSelectActionItemProps) => {
  const { rows, variant = 'icon' } = props;
  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });
  const [open, setOpen] = useState(false);
  const [csv, setCsv] = useState<Blob | null>(null);
  const apiPost = useStoreActions((actions) => actions.api.post);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const isVpbx = aboutMe?.vpbx;

  const handleClickOpen = async () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  const handleSubmit = () => {
    const formData = new FormData();

    if (csv) {
      formData.append('csv', csv);
      formData.append('calendar', rows[0].calendar);
    }

    apiPost({
      path: `${HolidayDate.path}/mass_import`,
      values: formData,
      contentType: 'multipart/form-data',
    }).then(() => {
      setOpen(false);
      reload();
    });
  };

  const handleFileSelect = (file: File) => {
    setCsv(fileToBlob(file));
  };

  if (!isVpbx) {
    return <span className='display-none'></span>;
  }

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && <MoreMenuItem>{_('Import CSV')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip
            title={_('Import CSV')}
            placement='bottom'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta>
                <CloudUploadIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </a>
      <StyledDialog
        open={open}
        onClose={handleClose}
        aria-labelledby='alert-dialog-title'
        aria-describedby='alert-dialog-description'
      >
        <Box>
          <DialogTitle id='alert-dialog-title'>
            {_('Import Holiday Dates')}
          </DialogTitle>
          <DialogContent>
            <FileUpload onFileSelect={handleFileSelect} />
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleClose}>{_('Cancel')}</OutlinedButton>

            <SolidButton onClick={handleSubmit} autoFocus>
              {_('Send')}
            </SolidButton>
          </DialogActions>
        </Box>
      </StyledDialog>
    </>
  );
};

export default Import;
