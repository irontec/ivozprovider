import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';
import useDefaultLocation from './hooks/useDefaultLocation';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, properties, row, match } = props;
  const edit = props.edit || false;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const formik = useFormHandler(props);
  const usingDefaultLocation = useDefaultLocation(edit, formik);

  const readOnlyProperties = {
    location: usingDefaultLocation,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Personal data'),
      fields: ['name', 'lastname', 'email'],
    },
    edit && {
      legend: _('Geographic Configuration'),
      fields: [
        'language',
        'timezone',
        'transformationRuleSet',
        'useDefaultLocation',
        'location',
      ],
    },
    edit && {
      legend: _('Login Info'),
      fields: ['active', 'pass', 'gsQRCode'],
    },
    edit && {
      legend: _('Boss-Assistant'),
      fields: ['isBoss', 'bossAssistant', 'bossAssistantWhiteList'],
    },
    {
      legend: _('Basic Configuration'),
      fields: [
        'terminal',
        'extension',
        'outgoingDdi',
        'outgoingDdiRule',
        edit && 'callAcl',
        edit && 'doNotDisturb',
        edit && 'maxCalls',
        edit && 'externalIpCalls',
        edit && 'multiContact',
        edit && 'rejectCallMethod',
      ],
    },
    edit && {
      legend: _('Group belonging'),
      fields: [
        'pickupGroupIds',
        //@TODO 'HuntGroupMembers',
      ],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      formik={formik}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={readOnlyProperties}
    />
  );
};

export default Form;
