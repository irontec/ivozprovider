import { ScalarProperty } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

import { ClientFeatures, ClientTypes } from '../Company/ClientFeatures';
import { CallCsvSchedulerPropertyList } from './CallCsvSchedulerProperties';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { useCompanyDdis } from './hook/useCompanyDdis';
import { useCompanyFaxes } from './hook/useCompanyFaxes';
import { useCompanyFeatures } from './hook/useCompanyFeatures';
import { useCompanyFriends } from './hook/useCompanyFriends';
import { useCompanyResidentialDevice } from './hook/useCompanyResidentialDevice';
import { useCompanyRetailAccount } from './hook/useCompanyRetailAccount';
import { useCompanyUsers } from './hook/useCompanyUsers';

const Form = (props: EntityFormProps): JSX.Element | null => {
  const { entityService, match, row, properties } = props;

  const edit = props.edit || false;

  let fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const newProperties: CallCsvSchedulerPropertyList<ScalarProperty> = {
    ...properties,
  };

  const formik = useFormHandler(props);
  const clientType = formik.values.companyType;
  const companyId = formik.values[clientType];

  const retailId =
    formik.values.companyType === ClientTypes.retail
      ? formik.values.retail
      : null;
  const residentialId =
    formik.values.companyType === ClientTypes.residential
      ? formik.values.residential
      : null;

  const companyType = {
    ...properties.companyType,
    enum: { ...properties.companyType.enum },
  } as ScalarProperty;

  if (properties.companyType.enum) {
    companyType.enum = properties.companyType.enum;
  }

  const hasResidentialFeature = aboutMe?.features.includes(
    ClientTypes.residential
  );
  if (!hasResidentialFeature) {
    delete companyType.enum?.residential;
  }

  const hasWholesaleFeature = aboutMe?.features.includes(ClientTypes.wholesale);
  if (!hasWholesaleFeature) {
    delete companyType.enum?.wholesale;
  }

  const hasRetailFeature = aboutMe?.features.includes(ClientTypes.retail);
  if (!hasRetailFeature) {
    delete companyType.enum?.retail;
  }

  const hasVpbxFeature = aboutMe?.features.includes(ClientTypes.vpbx);
  if (!hasVpbxFeature) {
    delete companyType.enum?.vpbx;
  }

  newProperties.companyType = companyType;

  const customEndpointType =
    clientType === ClientTypes.residential
      ? properties.residentialEndpointType
      : properties.endpointType;

  const endpointType = {
    ...customEndpointType,
    enum: { ...customEndpointType.enum },
  } as ScalarProperty;

  const companyFeatures = useCompanyFeatures(companyId, clientType);

  const hasFaxesFeature = companyFeatures.includes(ClientFeatures.faxes);
  if (!hasFaxesFeature) {
    delete endpointType.enum?.fax;
  }

  const hasFriendsFeature = companyFeatures.includes(ClientFeatures.friends);
  if (!hasFriendsFeature) {
    delete endpointType.enum?.friend;
  }

  if (clientType === ClientTypes.vpbx) {
    newProperties.endpointType = endpointType;
  }

  if (clientType === ClientTypes.residential) {
    newProperties.residentialEndpointType = endpointType;
  }

  entityService.replaceProperties(newProperties);

  const ddi = useCompanyDdis(companyId);
  const user = useCompanyUsers(companyId);
  const fax = useCompanyFaxes(companyId);
  const friend = useCompanyFriends(companyId);
  const retailAccount = useCompanyRetailAccount(retailId);
  const residentialDevice = useCompanyResidentialDevice(residentialId);

  fkChoices = {
    ...fkChoices,
    ddi,
    user,
    fax,
    friend,
    retailAccount,
    residentialDevice,
  };
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Information'),
      fields: ['name', 'companyType', 'email', 'callCsvNotificationTemplate'],
    },
    {
      legend: _('Time Information'),
      fields: [
        'frequency',
        'unit',
        edit && 'nextExecution',
        edit && 'lastExecution',
      ],
    },
    {
      legend: _('Providers filters'),
      fields: ['callDirection', 'ddiProvider', 'carrier'],
    },
    {
      legend: _('Client filters'),
      fields: [
        hasVpbxFeature && 'vpbx',
        hasRetailFeature && 'retail',
        hasResidentialFeature && 'residential',
        hasWholesaleFeature && 'wholesale',
        'ddi',
        'endpointType',
        hasResidentialFeature && 'residentialEndpointType',
        hasVpbxFeature && 'user',
        hasFriendsFeature && 'friend',
        hasFaxesFeature && 'fax',
        hasRetailFeature && 'retailAccount',
        hasResidentialFeature && 'residentialDevice',
      ],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      formik={formik}
      fkChoices={fkChoices}
      groups={groups}
    />
  );
};

export default Form;
