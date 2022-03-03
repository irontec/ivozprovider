import ReceiptIcon from '@mui/icons-material/Receipt';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { InvoiceProperties } from './InvoiceProperties';
import { EntityValues } from 'lib/services/entity/EntityService';

const properties: InvoiceProperties = {
    'number': {
        label: _('Number'),
    },
    'inDate': {
        label: _('In date'),
        format: 'date-time',
    },
    'outDate': {
        label: _('Out date'),
        format: 'date-time',
    },
    'totalWithTax': {
        label: _('Total with tax'),

    },
    'pdf': {
        label: _('Pdf file'),
        type: 'file',
    }
};

const Invoice: EntityInterface = {
    ...defaultEntityBehavior,
    icon: ReceiptIcon,
    iden: 'Invoice',
    title: _('Invoice', { count: 2 }),
    path: '/invoices',
    properties,
    toStr: (row: EntityValues) => row.number as string,
};

export default Invoice;