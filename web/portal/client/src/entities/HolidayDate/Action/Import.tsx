import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
  isSingleRowAction,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import UploadFileIcon from '@mui/icons-material/UploadFile';
import { Box, Tooltip } from '@mui/material';
import FileUpload from 'components/FileUpload';
import Papa from 'papaparse';
import { useEffect, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import HolidayDate from '../HolidayDate';
import ImportHolidayDatesMappingTable from './ImportHolidayDates';

type ImporterResults = {
  errorMsg: string;
  success: number;
  failed: number;
};

const fileToBlob = (file: File): Blob => {
  return file.slice(0, file.size, file.type);
};

const Import: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;

  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });

  const [open, setOpen] = useState(false);
  const [csv, setCsv] = useState<Array<string>[]>([]);
  const [file, setFile] = useState<File | null>(null);

  const apiPost = useStoreActions((actions) => actions.api.post);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const isVpbx = aboutMe?.vpbx;

  const calendarId = useStoreState((state) => state.list.parentRow?.id);

  const [step, setStep] = useState(1);
  const [result, setResult] = useState<ImporterResults>();

  const handleClickOpen = async () => {
    setOpen(true);
  };

  const handleClose = () => {
    const mustReload = step === 3;
    setStep(1);
    setOpen(false);

    if (mustReload) {
      reload();
    }
  };

  const handleNext = () => {
    setStep(step + 1);
  };

  const [columns, setColumns] = useState(['name', 'eventDate']);

  const [ignoreFirstLine, setIgnoreFirstLine] = useState(false);

  useEffect(() => {
    if (file === null) {
      return;
    }

    const fileReader = new FileReader();

    fileReader.onload = () => {
      const csvObj = Papa.parse<string[]>(fileReader.result as string, {
        delimiter: ';',
        quoteChar: '"',
        escapeChar: '\\',
      });
      setCsv(csvObj.data.slice(0, -1));
    };

    fileReader.readAsText(file);
  }, [file]);

  const handleSubmit = () => {
    const formData = new FormData();

    if (file !== null) {
      formData.append('csv', fileToBlob(file));
    }

    formData.append('calendar', calendarId?.toString() ?? '');

    formData.append(
      'importerArguments',
      JSON.stringify({
        escape: null,
        columns: columns,
        delimiter: ';',
        enclosure: '"',
        ignoreFirst: ignoreFirstLine,
      })
    );

    apiPost({
      path: `${HolidayDate.path}/mass_import`,
      values: formData,
      contentType: 'multipart/form-data',
    }).then((response) => {
      try {
        setResult(response.data as ImporterResults);
      } catch (e) {
        setResult({
          errorMsg: '',
          success: 0,
          failed: 0,
        });
      } finally {
        handleNext();
      }
    });
  };

  if (!isVpbx) {
    return <span className='display-none'></span>;
  }

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const showResults = (result: ImporterResults) => {
    if (result.failed > 0) {
      const errors = JSON.parse(result.errorMsg);

      return (
        <ul>
          {errors.map((e) => (
            <li key={`line${e.line}`}>{_(`Line ${e.line}: ${e.msg}`)}</li>
          ))}
        </ul>
      );
    }

    if (!result.success) {
      return <div>{_('Unkown error. No lines where imported')}</div>;
    }

    return <div>{_('All lines have been imported')}</div>;
  };

  const customButtons = [
    {
      label: step === 3 ? _('Close') : _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: step === 2 ? _('Send') : _('Continue'),
      onClick: step === 2 ? handleSubmit : handleNext,
      variant: 'solid' as const,
      autoFocus: true,
      disabled: file === null,
    },
  ];

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem>{_('Import Holiday Dates')}</MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Import Holiday Dates')}
            placement='bottom-start'
            enterTouchDelay={0}
          >
            <StyledTableRowCustomCta>
              <UploadFileIcon color='primary' />
            </StyledTableRowCustomCta>
          </Tooltip>
        )}
      </a>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Import Holiday Dates')}
          buttons={customButtons}
          keepMounted={true}
        >
          <Box sx={step !== 1 ? { display: 'none' } : {}}>
            <FileUpload onFileSelect={setFile} />
          </Box>
          {step === 2 && (
            <Box sx={{ textAlign: 'left' }}>
              <p>{_('Fields with * are required.')}</p>
              <ul>
                <li>{_('Name*: Holiday name')}</li>
                <li>{_('Date*: Event date')}</li>
              </ul>
              <p>
                {_(
                  'The columns must be separated by semicolons (;) and the strings enclosed in double quotes (""). The escape character is the backslash (\\).)'
                )}
              </p>
              <p>{_('For example')}:</p>
              <p>&quot;{_('New year`s eve')}&quot;, &quot;2024-12-31&quot;</p>
              <ImportHolidayDatesMappingTable
                csv={csv}
                columns={columns}
                setColumns={setColumns}
                ignoreFirstLine={ignoreFirstLine}
                setIgnoreFirstLine={setIgnoreFirstLine}
              />
            </Box>
          )}
          {step === 3 && (
            <Box sx={{ textAlign: 'left' }}>
              <p>{_('Result')}</p>
              {showResults(result)}
            </Box>
          )}
        </Modal>
      )}
    </>
  );
};

export default Import;
