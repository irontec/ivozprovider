import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const edit = props.edit || false;
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Personal data'),
      fields: ['name', 'lastname', 'email'],
    },
    edit && {
      legend: _('Geographic Configuration'),
      fields: ['language', 'timezone', 'transformationRuleSet', 'location'],
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

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
