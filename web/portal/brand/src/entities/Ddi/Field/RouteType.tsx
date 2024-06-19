import { ListDecorator, ScalarProperty } from '@irontec/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { useStoreState } from 'store';

import { ClientFeatures } from '../../../entities/Company/ClientFeatures';
import { DdiPropertyList } from '../DdiProperties';

type RouteTypeValues = DdiPropertyList<string>;
type RouteTypeProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<RouteTypeValues>
>;

const RouteType: RouteTypeProps = (props): JSX.Element | null => {
  const { _context, _columnName, property, values, formFieldFactory } = props;
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (_context === 'read' || !formFieldFactory) {
    return (
      <ListDecorator
        field={_columnName}
        row={values}
        property={property}
        ignoreCustomComponent={true}
      />
    );
  }

  const { choices, readOnly } = props;
  const modifiedProperty = { ...property } as ScalarProperty;
  delete modifiedProperty.component;

  if (!aboutMe) {
    return formFieldFactory.getInputField(
      _columnName,
      modifiedProperty,
      choices,
      readOnly
    );
  }

  const enumValues = {
    ...modifiedProperty.enum,
  };

  if (!aboutMe.vpbx) {
    delete enumValues.user;
    delete enumValues.ivr;
    delete enumValues.huntGroup;
    delete enumValues.conditional;
  }

  if (!aboutMe.residential) {
    delete enumValues.residential;
  }

  if (!aboutMe.retail) {
    delete enumValues.retail;
    delete enumValues.retailAccount;
  }

  const companyFeatures = aboutMe.features;
  const conditionalFeatures: Record<string, string> = {
    [ClientFeatures.queues]: 'queue',
    [ClientFeatures.friends]: 'friend',
    [ClientFeatures.faxes]: 'fax',
    [ClientFeatures.conferences]: 'conferenceRoom',
  };
  const conditionalFeaturesKeys = Object.keys(conditionalFeatures);

  for (const conditionalFeature of conditionalFeaturesKeys) {
    if (companyFeatures.includes(conditionalFeature)) {
      continue;
    }

    delete enumValues[conditionalFeatures[conditionalFeature]];
  }

  modifiedProperty.enum = enumValues;

  return formFieldFactory.getInputField(
    _columnName,
    modifiedProperty,
    choices,
    readOnly
  );
};

export default RouteType;
