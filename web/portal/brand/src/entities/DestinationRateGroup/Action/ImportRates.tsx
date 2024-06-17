import {
  EmbeddableProperty,
  EntityValidatorResponse,
} from '@irontec-voip/ivoz-ui';
import { MoreMenuItem } from '@irontec-voip/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec-voip/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  OutlinedButton,
  SolidButton,
} from '@irontec-voip/ivoz-ui/components/shared/Button/Button.styles';
import { useFormHandler } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec-voip/ivoz-ui/router/routeMapParser';
import { FileUploadFactory } from '@irontec-voip/ivoz-ui/services/form/FormFieldFactory/Factory/FileUploadFactory';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import UploadFileIcon from '@mui/icons-material/UploadFile';
import {
  Box,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  styled,
  Tooltip,
} from '@mui/material';
import Papa from 'papaparse';
import { useEffect, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import DestinationRateGroup from '../DestinationRateGroup';
import ImportRatesMappingTable from './ImportRatesMappingTable';

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

const ImportRates: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, entityService, variant = 'icon' } = props;
  const formik = useFormHandler({
    create: false,
    entityService,
    fixedValues: {},
    filterValues: {},
    filterBy: undefined,
    initialValues: row,
    validator: (values) => values as EntityValidatorResponse,
    onSubmit: async () => {
      /* noop */
    },
  });

  const [open, setOpen] = useState(false);
  const [csv, setCsv] = useState<Array<string>[]>([]);

  const apiPut = useStoreActions((actions) => {
    return actions.api.put;
  });
  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });

  const fileProperty = useStoreState(
    (state) => state.entities.entities.DestinationRateGroup.properties.file
  );
  const [step, setStep] = useState(1);

  const [columns, setColumns] = useState([
    'destinationName',
    'destinationPrefix',
    'rateCost',
    'connectionCharge',
    'rateIncrement',
  ]);

  const [ignoreFirstLine, setIgnoreFirstLine] = useState(false);

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setStep(1);
    setOpen(false);
  };

  const handleSubmit = () => {
    const formData = new FormData();
    formData.append('file', formik.values.file.file);

    formData.append(
      'destinationRateGroup',
      JSON.stringify({
        importerArguments: {
          scape: null,
          columns: columns,
          delimiter: ',',
          enclosure: '"',
          ignoreFirst: ignoreFirstLine,
        },
      })
    );

    apiPut({
      path: `${DestinationRateGroup.path}/${row.id}`,
      values: formData,
    }).then(() => {
      setOpen(false);
      reload();
    });
  };

  const handleNext = () => {
    setStep(2);
  };

  const fileUploaded = !!formik.values.file.file;

  useEffect(() => {
    if (fileUploaded) {
      const fileReader = new FileReader();

      fileReader.onload = () => {
        const csvObj = Papa.parse<string[]>(fileReader.result as string);
        setCsv(csvObj.data.slice(0, -1));
      };
      fileReader.readAsText(formik.values.file.file);
    }
  }, [fileUploaded, formik.values.file.file]);

  if (!row) {
    return null;
  }

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && <MoreMenuItem>{_('Import Rates')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip
            title={_('Import Rates')}
            placement='bottom-start'
            enterTouchDelay={0}
          >
            <StyledTableRowCustomCta>
              <UploadFileIcon color='primary' />
            </StyledTableRowCustomCta>
          </Tooltip>
        )}
      </a>
      <StyledDialog
        open={open}
        onClose={handleClose}
        aria-labelledby='alert-dialog-title'
        aria-describedby='alert-dialog-description'
        className={step === 1 ? '' : 'width'}
      >
        <Box>
          <DialogTitle id='alert-dialog-title'>{_('Import Rates')}</DialogTitle>
          <DialogContent>
            <Box sx={step !== 1 ? { display: 'none' } : {}}>
              <FileUploadFactory
                fld='file'
                property={{ ...fileProperty, label: '' } as EmbeddableProperty}
                choices={null}
                disabled={false}
                hasChanged={false}
                entityService={entityService}
                formik={formik}
                changeHandler={formik.handleChange}
                handleBlur={formik.handleBlur}
              />
            </Box>
            {step === 2 && (
              <Box sx={{ textAlign: 'left' }}>
                <p>
                  {_('Import file. Set column configuration and continue.')}
                </p>
                <p>{_('Fields with * are required.')}</p>
                <ul>
                  <li>{_('Destination Name*: Rate Name')}</li>
                  <li>{_('Prefix*: Prefix with + sign')}</li>
                  <li>{_('Per minute charge*: Per minute charge')}</li>
                  <li>{_('Connection charge*: Connection charge')}</li>
                  <li>{_('Charge period*: Charge period')}</li>
                </ul>
                <ImportRatesMappingTable
                  csv={csv}
                  columns={columns}
                  setColumns={setColumns}
                  ignoreFirstLine={ignoreFirstLine}
                  setIgnoreFirstLine={setIgnoreFirstLine}
                />
              </Box>
            )}
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleClose}>Cancel</OutlinedButton>
            {step === 1 && (
              <SolidButton
                onClick={handleNext}
                autoFocus
                disabled={!fileUploaded}
              >
                {_('Continue')}
              </SolidButton>
            )}
            {step === 2 && (
              <SolidButton onClick={handleSubmit} autoFocus>
                {_('Send')}
              </SolidButton>
            )}
          </DialogActions>
        </Box>
      </StyledDialog>
    </>
  );
};

export default ImportRates;
