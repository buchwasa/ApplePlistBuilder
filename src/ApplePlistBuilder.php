<?php

namespace appleplistbuilder;

$path = dirname(__FILE__, 2) . "/vendor/autoload.php";
if(is_file($path)){
	require_once($path);
}

class ApplePlistBuilder{
	/** @var \SimpleXMLElement */
	private $xml;

	public function __construct(string $bundleId, string $title, string $url, string $bundleVersion = "0.33.1", string $assetKind = "software-package", string $metadataKind = "software"){
		$this->xml = simplexml_load_string(
			<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
		<plist version="1.0">
            <dict>
                <key>items</key>
                <array>
                    <dict>
                        <key>assets</key>
                        <array>
                            <dict>
                                <key>kind</key>
                                <string>$assetKind</string>
                                <key>url</key>
                                <string>$url</string>
                            </dict>
                        </array>
                        <key>metadata</key>
                        <dict>
                            <key>bundle-identifier</key>
                            <string>$bundleId</string>
                            <key>bundle-version</key>
                            <string>$bundleVersion</string>
                            <key>kind</key>
                            <string>$metadataKind</string>
                            <key>title</key>
                            <string>$title</string>
                        </dict>
                    </dict>
                </array>
            </dict>
        </plist>
XML
		);
	}

	public function getAssets(){
		return $this->xml->dict->array->dict->array->dict;
	}

	public function getMetadata(){
		return $this->xml->dict->array->dict->dict;
	}

	public function getAssetKind() : string{
		return $this->getAssets()->string[0];
	}

	public function getUrl() : string{
		return $this->getAssets()->string[1];
	}

	public function getBundleId() : string{
		return $this->getMetadata()->string[0];
	}

	public function getBundleVersion() : string{
		return $this->getMetadata()->string[1];
	}

	public function getMetadataKind() : string{
		return $this->getMetadata()->string[2];
	}

	public function getTitle() : string{
		return $this->getMetadata()->string[3];
	}

	public function getPlist(){
		return $this->xml;
	}
}
