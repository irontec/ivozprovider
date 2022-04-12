import { styled } from '@mui/material';
import { CancelTokenSource } from 'axios';
import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent, PropertyCustomFunctionComponentProps,
  CustomFunctionComponentContext,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { useEffect, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';
import { LocutionPropertyList } from '../LocutionProperties';

type RecordingExtensionValues = LocutionPropertyList<string | number>;
type RecordingExtensionType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<RecordingExtensionValues & { className: string }>>;

const RecordingExtension: RecordingExtensionType = (props): JSX.Element | null => {

  const { formik, _context, values } = props;
  const isListValue = !formik && _context === CustomFunctionComponentContext.read;

  const recordLocutionServiceLoader = useStoreActions((actions) => {
    return actions.clientSession.recordLocutionService.load;
  });
  const cancelTokenSourceFactory = useStoreState(
    (store) => store.api.reqCancelTokenSourceFactory,
  );
  const [cancelTokenSource] = useState<CancelTokenSource>(cancelTokenSourceFactory());

  useEffect(
    () => {
      recordLocutionServiceLoader({ cancelTokenSource });

      return (() => {
        cancelTokenSource.cancel();
      });
    },
    [recordLocutionServiceLoader, cancelTokenSource],
  );

  const recordLocutionService = useStoreState(
    (state) => state.clientSession.recordLocutionService.recordLocutionService,
  );
  const serviceEnabled = useStoreState(
    (state) => state.clientSession.recordLocutionService.serviceEnabled,
  );

  const className = isListValue
    ? ''
    : props.className;

  let code = '';
  if (recordLocutionService !== null && serviceEnabled) {
    code = `*${recordLocutionService.defaultCode}${values.id}`;
  }

  return (
        <span className={className}>{code}</span>
  );
};

export const StyledRecordingExtension = styled(
  RecordingExtension,
)(
  () => {
    return {
      'color': 'rgba(0, 0, 0, 0.5)',
    };
  },
);

export default withCustomComponentWrapper<RecordingExtensionValues>(StyledRecordingExtension);