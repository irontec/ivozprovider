import { ScalarProperty, PropertyList } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { useCompanyDdis } from './hook/useCompanyDdis';
import { useCompanyFaxes } from './hook/useCompanyFaxes';
import { useCompanyFriends } from './hook/useCompanyFriends';
import { useCompanyResidentialDevice } from './hook/useCompanyResidentialDevice';
import { useCompanyRetailAccount } from './hook/useCompanyRetailAccount';
import { useCompanyUsers } from './hook/useCompanyUsers';

const Form = (props: EntityFormProps): JSX.Element | null => {
  const { entityService, match, row, properties } = props;

  const edit = props.edit || false;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  let fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const newProperties: PropertyList = { ...properties };

  const companyType = {
    ...properties.companyType,
    enum: { ...properties.companyType.enum },
  } as ScalarProperty;
  const hasResidentialFeature = aboutMe?.features.includes('residential');
  if (!hasResidentialFeature) {
    delete companyType.enum.residential;
  }

  const hasWholesaleFeature = aboutMe?.features.includes('wholesale');
  if (!hasWholesaleFeature) {
    delete companyType.enum.wholesale;
  }

  const hasRetailFeature = aboutMe?.features.includes('retail');
  if (!hasRetailFeature) {
    delete companyType.enum.retail;
  }

  const hasVpbxFeature = aboutMe?.features.includes('vpbx');
  if (!hasVpbxFeature) {
    delete companyType.enum.vpbx;
  }
  newProperties.companyType = companyType;

  const endpointType = {
    ...properties.endpointType,
    enum: { ...properties.endpointType.enum },
  } as ScalarProperty;
  const hasFaxesFeature = aboutMe?.features.includes('faxes');
  if (!hasFaxesFeature) {
    delete endpointType.enum.fax;
  }
  const hasFriendsFeature = aboutMe?.features.includes('friends');
  if (!hasFriendsFeature) {
    delete endpointType.enum.friend;
  }
  newProperties.endpointType = endpointType;

  entityService.replaceProperties(newProperties);

  const formik = useFormHandler(props);
  const companyId = formik.values[formik.values.companyType];
  const retailId =
    formik.values.companyType === 'retail' ? formik.values.retail : null;
  const residentialId =
    formik.values.companyType === 'residential'
      ? formik.values.residential
      : null;

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
