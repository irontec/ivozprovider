import { styled, Theme } from '@mui/material';

import Dashboard from './Dashboard';

const StyledDashboard = styled(Dashboard)(({ theme }: { theme: Theme }) => {
  return {
    display: 'grid',
    gridTemplateColumns: '1fr 1fr 1fr',
    gridAutoFlow: 'row dense',
    gap: 'var(--spacing-lg)',

    maxWidth: '1400px',

    [theme.breakpoints.down('md')]: {
      gridTemplateColumns: '1fr',
    },

    '& .card': {
      padding: 'var(--spacing-xl)',
    },

    '& .welcome': {
      backgroundColor: 'var(--color-primary)',
      color: 'white',
      display: 'flex',
      alignItems: 'center',
      container: 'welcome / inline-size',
      [theme.breakpoints.up('md')]: {
        gridColumn: 'auto / span 2',
      },
      [theme.breakpoints.between('md', 'lg')]: {
        gridColumn: 'auto / span 3',
      },
      '& .card-container': {
        display: 'flex',
        gap: 'var(--spacing-xl)',
      },
      '& h3': {
        fontSize: '21px',
        margin: '0',
      },
      '& p': {
        fontSize: '14px',
      },
      '& img': {
        width: '35%',
        maxWidth: '260px',
      },
      '& button': {
        background: 'var(--color-background-elevated)',
        color: 'var(--color-primary)',
        boxShadow: '0px 0px 7px #1111111a',
      },
    },

    ['@container welcome (max-width: 400px)']: {
      '& .welcome': {
        '& .card-container': {
          flexDirection: 'column-reverse',

          '& img': {
            width: '100%',
            marginInline: 'auto',
          },
        },
      },
    },

    '& .activity': {
      [theme.breakpoints.between('md', 'lg')]: {
        gridColumn: 'auto / span 3',
      },

      '& .title': {
        fontSize: '18px',
        marginBottom: 'var(--spacing-md)',
        fontWeight: '500',
      },

      '& .content': {
        display: 'grid',
        gridTemplateColumns: 'max-content 1fr',
      },

      '& .row': {
        display: 'contents',
        fontSize: '14px',
      },

      '& .time, & .value': {
        paddingBlock: 'var(--spacing-sm)',
        paddingInline: 'var(--spacing-md)',
        color: 'var(--color-text)',
      },

      '& .time': {
        borderInlineEnd: '1px solid var(--color-border)',
        textAlign: 'end',
      },
    },

    '& .amount': {
      padding: 'var(--spacing-lg)',
      display: 'grid',
      gridTemplateColumns: '65px 1fr 1fr',
      gridTemplateAreas: "'img number progress' 'img name link'",
      columnGap: 'var(--spacing-md)',
      rowGap: 'var(--spacing-sm)',

      [theme.breakpoints.between('md', 'lg')]: {
        gridColumn: 'auto / span 3',
      },

      '& .img-container': {
        gridArea: 'img',
        display: 'flex',
        alignItems: 'center',
        '& img': {
          width: '100%',
        },
      },

      '& .number': {
        gridArea: 'number',
        fontSize: '32px',
      },

      '& .name': {
        gridArea: 'name',
        color: 'var(--color-text)',
      },

      '& .progress': {
        gridArea: 'progress',
        display: 'flex',
        alignItems: 'flex-start',
        gap: 'var(--spacing-sm)',
        justifySelf: 'flex-end',

        '& span': {
          whiteSpace: 'nowrap',
        },
      },

      '& .link': {
        gridArea: 'link',
        fontSize: '14px',
        justifySelf: 'flex-end',
        textAlign: 'end',
      },
    },

    '& .licenses': {
      padding: '0',
      display: 'flex',
      flexDirection: 'column',
      '& .title': {
        padding: 'var(--spacing-lg)',
        paddingBlockEnd: '0',
        fontSize: '18px',
      },
      '& .radial': {
        display: 'grid',
        placeItems: 'center',
        position: 'relative',
        flexGrow: '1',
        padding: 'var(--spacing-lg)',
      },
      '& .circle': {
        minWidth: '160px',
        width: '100%',
        maxWidth: '260px',
        aspectRatio: '1',
        background: `
          radial-gradient(
            circle closest-side,
            white 0,
            white 82%,
            transparent 0%,
            transparent 100%,
            white 0
          ),
          conic-gradient(
            var(--color-danger) 0,
            var(--color-danger) var(--inbound),
            var(--color-warning) 0,
            var(--color-warning) var(--outbound)
          )
        `,
      },
      '& .data': {
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        position: 'absolute',
      },
      '& .total': {
        fontSize: '13px',
        color: 'var(--color-text)',
      },
      '& .number': {
        fontSize: '24px',
        fontWeight: 'bold',
      },
      '& .legend': {
        display: 'flex',
        justifyContent: 'space-between',
        padding: 'var(--spacing-md)',
        borderTop: '1px solid var(--color-border)',
        gap: 'var(--spacing-sm)',
      },
      '& .label': {
        display: 'flex',
        alignItems: 'center',
        gap: 'var(--spacing-sm)',
      },
      '& .color': {
        width: '20px',
        height: '20px',
        borderRadius: '50%',
      },
      '& .red': {
        backgroundColor: 'var(--color-danger)',
      },
      '& .orange': {
        backgroundColor: 'var(--color-warning)',
      },
    },

    '& .last': {
      padding: 0,
      [theme.breakpoints.between('md', 'lg')]: {
        gridColumn: 'auto / span 3',
      },
      [theme.breakpoints.up('lg')]: {
        gridColumn: 'auto / span 2',
      },
      '& .header': {
        padding: 'var(--spacing-lg)',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        fontSize: '18px',
        borderBottom: '1px solid var(--color-border)',
      },
      '& .table': {
        padding: 'var(--spacing-md)',
      },
    },
  };
});

export default StyledDashboard;
