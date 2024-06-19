import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

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
      legend: _('Login Info'),
      fields: ['name', 'password'],
    },
    edit && {
      legend: _('Connection Info'),
      fields: [
        'allowAudio',
        'allowVideo',
        'directMediaMethod',
        't38Passthrough',
        'rtpEncryption',
      ],
    },
    {
      legend: _('Provisioning Info'),
      fields: ['terminalModel', 'mac', edit && 'lastProvisionDate'],
    },
    edit && {
      legend: _('Status'),
      fields: ['status'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
