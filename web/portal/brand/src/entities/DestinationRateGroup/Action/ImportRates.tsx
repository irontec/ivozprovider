import { EmbeddableProperty, EntityValidatorResponse } from '@irontec/ivoz-ui';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import { FileUploadFactory } from '@irontec/ivoz-ui/services/form/FormFieldFactory/Factory/FileUploadFactory';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import UploadFileIcon from '@mui/icons-material/UploadFile';
import { Box, Tooltip } from '@mui/material';
import Papa from 'papaparse';
import { useEffect, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import DestinationRateGroup from '../DestinationRateGroup';
import ImportRatesMappingTable from './ImportRatesMappingTable';

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

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: step === 1 ? _('Continue') : _('Send'),
      onClick: step === 1 ? handleNext : handleSubmit,
      variant: 'solid' as const,
      autoFocus: true,
      disabled: step === 1 ? !fileUploaded : false,
    },
  ];

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
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Import Rates')}
          description={step === 1 ? _('Import file in CSV format') : undefined}
          buttons={customButtons}
        >
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
              <p>{_('Import file. Set column configuration and continue.')}</p>
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
        </Modal>
      )}
    </>
  );
};

export default ImportRates;
