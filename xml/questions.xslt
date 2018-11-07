<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <HTML>
      <BODY>
        <p>
          XML DOKUMENTUAREN BIHURKETA HTML TAULA BATEAN
        </p>
        <TABLE border="1">
          <THEAD>
            <TR>
              <TH>ePosta</TH>
              <TH>Galdera</TH>
              <TH>eZuzena</TH>
              <TH>eOKerrak</TH>
              <TH>ZAILTASUNA</TH>
              <TH>Gaia</TH>
            </TR>
          </THEAD>
        </TABLE>
        <xsl:for-each select="/GALDERAK/GALDERA">
          <TR>
            <TD>
              <FONT SIZE="2" COLOR="red" FACE="Verdana">
                <xsl:value-of select="EPOSTA"/>
                <BR/>
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <xsl:value-of select="ENUNTZIATUA"/>
                <BR/>
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <xsl:value-of select="eZuzena"/>
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <xsl:value-of select="eOkerrak"/>
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <xsl:value-of select="zailtasuna"/>
              </FONT>
            </TD>
            <TD>
              <FONT SIZE="2" COLOR="blue" FACE="Verdana">
                <xsl:value-of select="GAIA"/>
              </FONT>
            </TD>
          </TR>
        </xsl:for-each>
      </BODY>
    </HTML>
  </xsl:template>  
</xsl:stylesheet>