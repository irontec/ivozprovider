import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { useCompanyDdis } from './hook/useCompanyDdis';
import { useCompanyFaxes } from './hook/useCompanyFaxes';
import { useCompanyFriends } from './hook/useCompanyFriends';
import { useCompanyResidentialDevice } from './hook/useCompanyResidentialDevice';
import { useCompanyRetailAccount } from './hook/useCompanyRetailAccount';
import { useCompanyUsers } from './hook/useCompanyUsers';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, match, formik, row } = props;
  const edit = props.edit || false;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  let fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

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
        'vpbx',
        'retail',
        'residential',
        'wholesale',
        'ddi',
        'endpointType',
        'residentialEndpointType',
        'user',
        'friend',
        'fax',
        'retailAccount',
        'residentialDevice',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
